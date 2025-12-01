# Layout

レイアウトはMarkdownファイルの中でも役割ごとに異なる雛形。

Markdownはbasicテンプレートを使われるので、triadの中央コンテナ内での雛形である。

## basic

`/articles/`下でも`/scraps/`下でも`/pages/`下でもないMarkdownファイルのレイアウト。

レイアウト特有の追加要素はない。
MarkdownのASTがそのままHTML要素のASTに変換される。

## article

`/articles/`下のMarkdownファイルのレイアウト。

- コンテンツの先頭に次が並ぶ:
   1. ジャンル別アイコン
   2. ページタイトル (h1)
   3. ジャンル・タグ・執筆年月日
- コンテンツの末尾に墓石がある
