//! Markdown文字列をHTML文字列に変換するモジュール
//!
//! - 変換に限らずMarkdownに関するものは取り敢えずこのモジュールの範囲
//! - 実際はlayoutモジュールに委譲する

use crate::strutil::*;

use markdown::{
    Constructs, ParseOptions,
    mdast::{Node, Yaml},
};
use serde::Deserialize;
use serde_yaml::Value;
use std::{
    collections::HashSet,
    path::{Path, PathBuf},
};

mod convert;
mod layout;

struct Context<'a> {
    frontmatter_value: Value,
    buf: String,
    styles: &'a mut HashSet<StrPtr>,
}

fn extract_frontmetter_yaml(mdast: &Node) -> &Yaml {
    let Node::Root(root) = mdast else {
        panic!("Rootじゃないやん: {:?}", mdast.position());
    };
    let Some(Node::Yaml(yaml)) = root.children.first() else {
        panic!("frontmatterが書かれてないやん: {:?}", mdast.position());
    };
    yaml
}

#[derive(Deserialize)]
struct BasicFrontmatter {
    title: String,
    layout: String,
}

pub fn to_index_html_path(path: &Path) -> PathBuf {
    let mut path = PathBuf::from(path);
    if path.file_stem().unwrap() == "index" {
        path.set_extension("html");
    } else {
        path.set_extension("");
        path.push("index.html");
    }
    path
}

pub fn to_html_segments(content: &str) -> Vec<StrOrString> {
    let options = ParseOptions {
        constructs: Constructs {
            code_indented: false,
            frontmatter: true,
            html_flow: false,
            html_text: false,
            math_flow: true,
            math_text: true,
            mdx_jsx_flow: true,
            mdx_jsx_text: true,
            ..Default::default()
        },
        ..Default::default()
    };
    let mdast = markdown::to_mdast(content, &options).unwrap();
    let frontmatter_yaml = extract_frontmetter_yaml(&mdast);
    let frontmatter_value = serde_yaml::from_str::<Value>(&frontmatter_yaml.value).unwrap();

    let frontmatter =
        serde_yaml::from_value::<BasicFrontmatter>(frontmatter_value.clone()).unwrap();

    let mut styles = HashSet::new();
    const MD_STYLE: &str = include_str!("../asset/style/md.css");
    styles.insert(StrPtr(MD_STYLE));

    let mut ctx = Context {
        frontmatter_value,
        buf: String::new(),
        styles: &mut styles,
    };
    layout::to_html(&frontmatter.layout, &mdast, &mut ctx);

    const HTML_STYLE: &str = "\
        <!DOCTYPE html>\
        <html lang=\"ja\">\
        <head>\
            <meta charset=\"UTF-8\">\
            <meta name=\"viewport\" content=\"width=device-width\">\
            <link rel=\"icon\" href=\"/favicon.ico\">\
            <style>\
    ";
    const STYLE_TITLE: &str = "\
            </style>\
            <title>\
    ";
    const TITLE_BODY: &str = "\
            </title>\
        </head>\
        <body>\
    ";
    const BODY_HTML: &str = "\
        </body>\
        </html>\
    ";

    let mut segments = Vec::with_capacity(6 + ctx.styles.len());
    segments.push(StrOrString::Str(HTML_STYLE));
    for style in ctx.styles.iter() {
        segments.push(StrOrString::Str(style.0));
    }
    segments.push(StrOrString::Str(STYLE_TITLE));
    segments.push(StrOrString::String(frontmatter.title));
    segments.push(StrOrString::Str(TITLE_BODY));
    segments.push(StrOrString::String(ctx.buf));
    segments.push(StrOrString::Str(BODY_HTML));
    segments
}
