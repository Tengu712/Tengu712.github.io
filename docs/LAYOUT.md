# Layout

## basic

本ホームページの基本レイアウト。

- ヘッダーがある
- 中央にコンテンツがある
  - コンテンツの末尾に墓石がある
- 右に目次がある
- フッターがある

パラメータ:

- `index`: `disable`を指定すると右の目次を消せる (optional)
- `tombstone`: `disable`を指定すると墓石を消せる (optional)
- `title`: ページタイトル
- `genre`: ジャンル (optional)
- `tags`: タグ (optional)
- `date`: 執筆年月日`YYYY/MM/DD` (optional)

## posts

記事専用レイアウト。

- ヘッダーがある
- 中央にコンテンツがある
  - コンテンツの先頭にページタイトルのH1がある
  - コンテンツの末尾に墓石がある
  - コンテンツの下に前の記事と次の記事へのリンクがある
- 右に目次がある
- フッターがある

パラメータ:

- `title`: ページタイトル
- `genre`: ジャンル
- `tags`: タグ
- `date`: 執筆年月日`YYYY/MM/DD`
