---
title: "proc_macroの雑な使い方"
genre: "prog"
tags: ["rust"]
date: "2026/01/06"
---

## macro_rules!

ありがたいことに、Rustにはマクロがあります。
`macro_rules!`によって定義し、`!`サフィックスを付して展開できます。
RustのマクロはC言語のそれとLispのそれの中間的な機能であり、構文木の弱い変換を行います。
定義時に呼出しの構文を定め、展開時に構文木を出力するイメージです(語弊あり)。
文字列を出力するわけでなければ、構文木を計算の対象とできるわけでもありません。

`macro_rules!`はチューリング完全であるため、C++の黒魔術よろしくメタプログラミングもできます。
大抵のことはできます。
しかし、あくまで構文木を出力する機能であるため、例えば、次のような識別子の連結ができません:

```rs
macro_rules! define_collection {
    ($($id:ident: $ty:ty),*) => {
        pub struct Collection {
            $($id: $ty,)*
        }

        impl Collection {
            $(pub fn get_$id(&self) -> $ty { self.$id.clone() })*
        }
    };
}

// error: missing parameters for function definition
// |
// | $(pub fn get_$id(&self) -> $ty { self.$id })*
// |              ^
// |
define_collection!(a: i32, b: String);
```

他にも、次のような識別子からライフタイムパラメータへの変換もできません:

```rs
// error: unterminated character literal
// |
// | '$id
// | ^^^^
// |
macro_rules! to_lt {
    ($id:ident) => {
        '$id
    };
}
```

以上は`get_`と`$id`が、また`'`と`$id`が異なるトークンとして扱われるために問題が起きています。

また、マクロの展開はどこでも行えるわけではありません。
[Reference](https://doc.rust-lang.org/reference/macros.html)によると、マクロ展開は構文上次の構成要素として展開されます:

- 式あるいは文
- パターン
- 型
- アイテム (構造体や関数や)
- `extern`ブロック

つまり、よしんば上記の`to_lt`マクロが実現できても、以下のような使い方はできないということです:

```rs
// ライフタイムパタメータとして展開できない
struct Foo<to_lt!(a)>(&'a mut i32);

// 型の一部として展開できない
struct Bar<'a>(&to_lt!(a) mut i32);
```

もちろん、`Foo`構造体全体や`&mut i32`型全体としてマクロ展開すれば実現できます。
しかし、言わずもがな、可搬性が落ちます。



## proc_macro

[pastey](https://crates.io/crates/pastey)というクレートがあります。
`paste!`マクロ内の`[<>]`で囲まれた空白区切りの文字列を連結する便利なクレートです。
次のように書きます:

```rs
macro_rules! define_collection {
    ($($id:ident: $ty:ty),*) => {
        paste! {
            pub struct Collection {
                $($id: $ty,)*
            }

            impl Collection {
                $(pub fn [<get_ $id>](&self) -> $ty { self.$id.clone() })*
            }
        }
    };
}
```

このpasteマクロを実現するための機能が手続きマクロです。
手続きマクロは、言ってしまえば、木構造のトークン列操作です。
構文木ではないものの、Lispのマクロに近いものと言って良いでしょう。

手続きマクロを使うには専用のlibクレートを作成する必要があります。
Cargo.tomlに以下を書くと、手続きマクロ定義のアトリビュートである`#[proc_macro]`が使えるようになります。

```toml
[lib]
proc-macro = true
```

例えば、簡単に、`[]`で囲まれた識別子をライフタイムパラメータにするマクロは次のように書けます:

```rs
#[proc_macro]
pub fn lifetimes_macro(input: TokenStream) -> TokenStream {
    process_tokens(input)
}

fn process_tokens(input: TokenStream) -> TokenStream {
    let mut trees = Vec::new();
    for tt in input.into_iter() {
        match tt {
            // `[]`に囲まれているならば
            TokenTree::Group(g) if matches!(g.delimiter(), Delimiter::Bracket) => {
                // その中には識別子が1個だけあるはず
                let Some(TokenTree::Ident(id)) = g.stream().into_iter().next() else {
                    panic!("ident expected");
                };
                // ライフタイムパラメータに変換
                trees.push(TokenTree::Punct(Punct::new('\'', Spacing::Joint)));
                trees.push(TokenTree::Ident(Ident::new(&format!("{id}"), id.span())));
            }
            TokenTree::Group(g) => {
                trees.push(TokenTree::Group(Group::new(
                    g.delimiter(),
                    process_tokens(g.stream()),
                )));
            }
            _ => trees.push(tt),
        }
    }
    trees.into_iter().collect()
}
```

この`lifetimes_macro`マクロを使えば、以下が実現できます:

```rs
lifetimes_macro! {
    // struct Fuga<'a>(&'a mut i32);
    struct Fuga<[a]>(&[a] mut i32);
}
```

また、`TokenTree::Group(g)`の処理を次のようにすれば、

```rs
let id = g
    .stream()
    .into_iter()
    .map(|tt| {
        if let TokenTree::Ident(id) = tt {
            id.to_string()
        } else {
            panic!("ident expected");
        }
    })
    .collect::<String>();
trees.push(TokenTree::Ident(Ident::new(&id, Span::call_site())));
```

次のように`paste`マクロと同じことができます:

```rs
my_paste! {
    let [a b] = 0;
    assert_eq!(ab, 0);
}
```

以上、手続きマクロを使えば大抵どんなこともできるようになりました。
……が、このアプローチはあくまでトークン列操作であるため、あらゆることができるわけではありません。
例えば、`my_paste`マクロおよび`paste`マクロでは次の問題点があります:

- `let a[b c]d = 0;`のようにトークンの途中に挟めない(勿論`[a b c d]`のようにすれば良い話)
- `&[' a] mut i32`のようにライフタイムパラメータを生成できない(勿論`lifetimes_macro`を使えば良い話)



## 雑なproc_macro

多少面倒ですが、ちゃんと変形すればトークン列操作であっても前章の問題は克服できるでしょう。
しかし、面倒は面倒です。
律儀にトークン列操作をしなければならない道理はありません。
次のように文字列操作してしまえばいいのです:

```rs
#[proc_macro]
pub fn handy_concat(input: TokenStream) -> TokenStream {
    let mut result = input
        .to_string()
        .trim_matches('"')
        .replace(" [<", "[<")
        .replace(">] ", ">]")
        .to_string();
    while let Some(start) = result.find("[<") {
        let tks_start = start + 2;
        let Some(tks_len) = result[tks_start..].find(">]") else {
            break;
        };
        let tks_end = tks_start + tks_len;
        let tks = &result[tks_start..tks_end];
        let end = tks_end + 2;
        let s = tks
            .split_whitespace()
            .map(|s| s.trim_matches('"'))
            .collect::<String>();
        result.replace_range(start..end, &s);
    }
    result.parse().unwrap()
}
```

この`handy_concat`マクロには次の注意点があります:

- `macro_rules!`内で使うと識別子と記号との間に空白が入る。これを除去しないと変換後に意図しない空白が入る。そのため、`[<`と`>]`の前後の空白除去を行っている。
- 手続きマクロに渡される`TokenStream`は荒い字句解析と構造化がされる。つまり、ある程度正しい文でなければマクロが呼び出される前にエラーになる。例えば、`'`は単独で存在しえない。そのため、`[<>]`内の文字列リテラルはクォートを剥くという仕様にしている。

次のように使えます:

```rs
macro_rules! define_struct {
    ($id:ident) => {
        handy_concat! {
            struct Foo[<Bar Baz>]Fuga<[<"'" $id>]>(&[<"'" $id>] mut i32);
        }
    };
}

// struct FooBarBazFuga<'a>(&'a mut i32);
define_struct!(a);
```



## 雑記

- 高級版Cマクロという一発ネタ。Scrap案件だがまあ良いか。
- 勘違いでrustコンパイラのソースコードを読む羽目になった。`TokenStream::into_iter()`が`TokenTree`から`TokenTree`への変換(両者は全く異なる構造体)なの罠だろ。
- 諸事情あって手続きマクロを組んだが最終的に不要になった。ちゃんと設計すれば手続きマクロが出張ってくることはないのかもしれない。
