# homepage

## What is this?

天狗のホームページのリポジトリ。

## SSG

拡張子が`.xd`であるファイル中のカスタムタグが一般タグに変換される。

SSGには`src/index.js`をNode.jsで実行する。
結果は`out`ディレクトリに生成される。

```
node src/index.js
```

一般的なホームページのレイアウトでは、次のテンプレートを用いる。

```html
<!DOCTYPE html>
<html lang="ja">

<head>
  <CHeader />
  <title></title>
</head>

<CBody>
</CBody>

</html>
```

記事では、次のテンプレートを用いる。

```html
<!DOCTYPE html>
<html lang="ja">

<head>
  <CHeader />
  <PostTitle key="" />
</head>

<CBody>
  <Headline key="" />

  <hr>

  <!-- content -->

  <Tombstone />

  <hr>

  <Deadline key="" />
</CBody>

</html>
```