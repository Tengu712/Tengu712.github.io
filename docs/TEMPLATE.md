# Template

テンプレートはHTML文字列生成に利用される雛形。

## basic

次の特徴を持つ:

- Headerを持つ
- Footerを持つ
- Triadを持つ
- Indexを持つ (optional)

すべてのMarkdownソースは最終的にbasicテンプレートによってHTML文字列へ変換される。

> [!NOTE]
> どんなレイアウトであろうが、frontmatterに`index: false`を指定するとindexは生成されない。
