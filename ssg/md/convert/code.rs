//! コードをHTML要素に変換するモジュール

use std::sync::LazyLock;
use syntect::{
    highlighting::{Theme, ThemeSet},
    html::highlighted_html_for_string,
    parsing::SyntaxSet,
};

fn init_syntax_set() -> SyntaxSet {
    let mut builder = SyntaxSet::load_defaults_newlines().into_builder();
    builder.add_from_folder("./asset/syntax", false).unwrap();
    builder.build()
}

static SYNTAX_SET: LazyLock<SyntaxSet> = LazyLock::new(init_syntax_set);

fn init_theme() -> Theme {
    ThemeSet::get_theme("./asset/theme/dark_modern.tmTheme").unwrap()
}

static THEME: LazyLock<Theme> = LazyLock::new(init_theme);

pub fn to_html(code: &str, lang: &Option<String>) -> String {
    let syntax = if let Some(lang) = lang {
        SYNTAX_SET.find_syntax_by_extension(lang).unwrap()
    } else {
        SYNTAX_SET.find_syntax_plain_text()
    };
    highlighted_html_for_string(code, &SYNTAX_SET, syntax, &THEME).unwrap()
}
