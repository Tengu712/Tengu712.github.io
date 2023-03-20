# homepage

## セットアップ

1. PHPの動作するApache環境を用意する
2. 1.でこのリポジトリをclone
3. `/binary.sh`を実行する

## リダイレクト

サーバールート・すなわち`https://skdassoc.com`にアクセスすると、`/posts/index.php`にリダイレクトする。

## template

テンプレ。postsと同様の体裁を取りたい場合は`/template/_template.php`をコピペして用いる。

## css

汎用性のあるもののみを置く。固有のスタイルは各々のhtml/phpファイルに記す。

## posts

記事。「いつ書いたか」が重要であるもの。

目次ページは`/posts/index.php`。`tag`パラメータでタグ検索が行える。

記事ページは`/posts/post.php`。`id`パラメータで表示する記事を指定する。

以下の手順で記事を作成する：

1. 本文を書く
2. `/posts/`に適当なファイル名で保存する
3. `/posts/_indecies.php`の`$indecies`に情報を登録する

`$indecies`について：

* 目次での順番は`$indecies`内の順番に依存する
* `$indecies`直下のkeyは2.で保存したファイル名と同一である

## pages

常設記事。常に更新し続けるべきもの。

原則、`/pages/index.php`で各ページをリストアップする。

Aboutである`/pages/about.php`は例外的にヘッダーから飛ぶようにしている。

以下の手順で記事を作成する：

1. ページを作る
2. `/pages/`内の適当な場所へ保存する
3. `/pages/index.php`に2.へのリンクを登録する
