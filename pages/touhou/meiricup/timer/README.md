# timer

## Outline

テキストファイルに「hh:mm:ss」形式で残り時間を出力するタイマー。

ただし、テキストファイルは`./cnt.txt`。
残り時間がなくなると「FINAL RUN!」が出力される。

## Download

[ここをクリックするとダウンロードが始まります](https://skdassoc.com/data/tool/timer.exe)

## Usage

1. timer.exeを実行
2. 半角数字のみで「分」を入力してEnter
3. 初期値の設定された`./cnt.txt`が生成/上書される
4. 任意のタイミングでEnterを入力してタイマーを始動
5. `./cnt.txt`が一秒ごとに更新される

## Caution

軽く・かつ正確に一秒を待つために、DirectX Graphics Infrastructure(DXGI)を用いて垂直同期を取っている。
従って、DXGIが動作する環境が必要である。

リフレッシュレートは60fpsを決め打ちしているため、そうでない環境では期待しない動作をする。

タイマーを途中で一時停止する手段はない。
また、途中で中止したい場合は、プロセスを終了する。
つまり、コンソールを落とすなり、Ctrl+Cを送るなりする。

「FINAL RUN!」になるとプロセスは終了する。

## Build

ターゲットには「i686-pc-windows-msvc」を用いるのが良い。

dxgi.libが必要であるため、Windows SDKをインストールしておくのが良い。
