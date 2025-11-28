---
layout: post
title: "MakeのようなPythonデコレータ"
genre: "tech"
tags: ["build", "python"]
date: "2025/11/26"
---

## 動機

C/C++プロジェクトの開発環境として次の候補が挙げられます:

- パッケージマネージャ: vcpkg or Conan
- ビルドシステム: CMake or Meson

私は以下の理由でConan+Mesonを採用しています:

- vcpkgはバージョン指定やtriplet指定、ビルドタイプ別の依存変更等の高度な設定がやりにくい
- CMakeはとにかく書きにくく・読みにくい

ConanとMesonはPython製であるため、C/C++プロジェクトと言いつつもPython環境が必須となります。
それはそれで、クロスプラットフォームなビルド時処理の記述言語としてPythonを採用できるようになったので悪いことではありませんが。
Windowsは何をインストールするにせよ面倒である・かつ環境の汚れが気になるOSであるため、このPythonをインストールするのも一苦労であるという汚点があります。
uvはこのソリューションとなります。
uvを使えばPythonだけでなくConanもMesonもスマートに導入・管理できるのです。

ところで、Conan+Mesonを採用していても、C/C++のビルドコマンドは複雑なものになります。
これを緩和するために次の解決策が考えられます:

- バッチファイルやシェルスクリプトを書く
- Pythonスクリプトを書く
- タスクランナーを導入する

バッチファイルやシェルスクリプトが愚策であることは言うまでもありません。
複雑なコマンドを実行するならば、Pythonスクリプトはあっという間に汚くなってしまうでしょう。
従って、タスクランナーを導入することになります。
まず、タスクランナーとしてMakeを採用することが考えられます。
macOSとLinuxという、Makeの導入が容易で・かつ基礎コマンドの多くを共有している環境を想定するならばMakeで十分です。
しかし、Windowsも想定するならば、Makeのインストールが一苦労である上に・UNIX系と混在させるためにMakeから逐一Pythonスクリプトを呼ぶという滑稽な状況に陥ってしまいます。
Makeの代替であるjustでも同様です。

当然ながら、この世にはuvでインストールできるタスクランナーがあります:

- taskipy
- Poetry
- doit

しかし、doitを除く二つはあくまでタスクランナーであり、依存関係を追跡・解決する機能を持ちません。
また、doitはその機能を持ちますが、現在メンテナンスされているとは言い難い状況にあります。
すぐに破壊的変更をするPythonという言語においてメンテナンスされていないものを使いたいとは積極的には思えません。

そこで、Makeのような依存関係を追跡・解決する機能を持つPythonスクリプトを自力実装して、上記タスクランナーと併用することにしました。



## 実装

次のようにデコレータ`task`を定義します:

```py
# scripts/make.py
import inspect
import subprocess
import sys
from functools import wraps
from pathlib import Path

def task(trg=None, deps=None):
	def decorator(func):
		@wraps(func)
		def wrapper():
			if deps:
				for d in deps:
					if callable(d):
						d()

			func_param_count = len(inspect.signature(func).parameters)

			if func_param_count == 0:
				ret = lambda: func()
			elif func_param_count == 1:
				ret = lambda: func(trg)
			else:
				ret = lambda: func(trg, deps)

			if trg is None:
				return ret()

			trg_path = Path(trg)

			if not trg_path.exists():
				return ret()

			dep_paths = [Path(d) for d in (deps or []) if isinstance(d, str)]

			for d in dep_paths:
				if not d.exists():
					print(f"error: task dependency not found: {d}")
					sys.exit(1)

			trg_mtime = trg_path.stat().st_mtime

			if any(d.stat().st_mtime > trg_mtime for d in dep_paths):
				return ret()

			print(f"{trg} is up to date")

		return wrapper
	return decorator
```



## 使用方法

次のように使用します:

```py
# scripts/tasks.py
from . import conan
from . import meson
from .make import task

@task("conan-deps/.stamp", ["conanfile.py"])
def install_dependencies(trg):
	conan.install()
	Path(trg).touch()

@task("build/.stamp")
def setup_build(trg):
	meson.setup()
	Path(trg).touch()

@task(None, [install_dependencies, setup_build])
def build():
	meson.compile()
```

これはMakefileでいう次と同じ動作をします(一部コマンドは簡略化):

```make
conan-deps/.stamp: conanfile.py
	conan install .
	touch $@

build/.stamp:
	meson setup build
	touch $@

.PHONY: build
build: conan-deps/.stamp build/.stamp
	meson compile -C build
```

例えば、taskipyを使うなら、次をpyproject.tomlに書き:

```toml
[tool.taskipy.tasks]
build = "python -c \"from scripts.tasks import build; build()\""
```

次のように呼び出します:

```
uv run task build
```

## 雑記

- 実質、わざわざ記事にするほどでもないもの第2弾。
- 本当はタスク関数に追加の情報を渡せるように改良してから執筆すべきだが、まあやりようによっては解決するので。
- ConanはConanで、プロファイルによるビルド環境の出し分けを売りにしているようだけれど、デフォルトプロファイルの一部だけプロジェクト統一設定で上書きするみたいなことができないせいで、ころころとバージョンを変えるMSVCへの対応がしづらくて使いにくい。……いや全部Microsoftが悪い。
- Pythonのデコレータ初めて実装したけど、広い波動拳撃ってて流石に褒められない。C系の文法の言語が無理して関数型を扱うから……。
