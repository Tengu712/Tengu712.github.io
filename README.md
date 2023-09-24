# homepage

## SSG

どうせ簡単なホームページなんて簡単なHTML文書でしかないので、わざわざSSRとかCSRとかする必要ないよな、ということでSSGするプログラムを組んだ。

使用言語はC#だが、Rustで書くよりは書きやすいかな、と思っただけで深い理由はない。

## Build

C#なのでWindows推奨。SSG結果は`/out/`に生成される。

1. [.NET SDKをインストール](https://dotnet.microsoft.com/ja-jp/download/dotnet)
1. リポジトリをclone
1. リポジトリルートで`dotnet run`

## New Post

新しい記事を投稿するには、

1. `/xml/posts/`にxmlファイルを追加する
1. `/xml/posts/_index.xml`ファイルにファイル名(拡張子なし)を追加する
1. `Program.Main()`にファイル名(拡張子なし)を与えた`Post`インスタンスを追加して`Generate()`する

ただし、xmlには以下の特殊なタグが必要。

- `<blob>`: 一番上の要素
- `<title>`: ページ・記事のタイトル
- `<date>`: 記事の執筆日
- `<tags>`: 記事のタグのコンテナ
- `<tag>`: 記事のタグ
- `<main>`: 記事の内容

## Coding Convention

パラダイムはOOPを、コーディング規則はC#っぽいのに則る。が、意見が分かれそうなのは以下。

- プロパティは基本的に無いものとする
- staticメンバの参照にはクラス名を付ける
- フィールドの参照には`this`を付ける
- privateフィールドはcamelCaseに従う
