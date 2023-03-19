# homepage

## index.php

当サイトの顔。主にブログ部分（目次と記事）を司る。`index.php`と`posts/`が該当。

記事は以下の手順で作成する：

1. 本文を書く
2. `homepage/posts/`に適当なファイル名で保存する
3. `homepage/posts/_post.php`の`$indecies`に情報を登録する
  * 目次での順番は`$indecies`内の順番に依存する
  * `$indecies`直下のkeyは2.で保存したファイル名と同一である
