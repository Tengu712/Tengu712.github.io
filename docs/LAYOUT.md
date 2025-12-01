# Layout

レイアウトはMarkdownファイルの中でも役割ごとに異なる雛形。

> [!NOTE]
> Markdownはbasicテンプレートを使われるので、triadの中央コンテナ内での雛形である。

## basic

他のレイアウトに該当しないすべてMarkdownファイルに該当する。

レイアウト特有の追加要素はない。
MarkdownのASTがそのままHTML要素のASTに変換される。

## article

[articles](/articles)下のMarkdownファイルのレイアウト。
次の特徴を持つ:

- コンテンツの先頭に次が並ぶ:
   1. ジャンル別アイコン
   2. ページタイトル (h1)
   3. ジャンル・タグ・執筆年月日
- コンテンツの末尾に墓石がある
