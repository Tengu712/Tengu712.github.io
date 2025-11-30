//! Markdown文字列をHTML文字列に変換するモジュール
//!
//! - 変換に限らずMarkdownに関するものは取り敢えずこのモジュールの範囲
//! - 実際はlayoutモジュールに委譲する

use crate::{strutil::*, template};

use markdown::{
    Constructs, ParseOptions,
    mdast::{Node, Yaml},
};
use serde::Deserialize;
use serde_yaml::Value;
use std::collections::HashSet;

mod convert;
mod layout;

struct Context<'a> {
    fm_value: Value,
    buf: String,
    styles: &'a mut HashSet<StrPtr>,
    h2s: Vec<String>,
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

pub fn to_html(content: &str) -> (String, Value) {
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
    let fm_yaml = extract_frontmetter_yaml(&mdast);
    let fm_value = serde_yaml::from_str::<Value>(&fm_yaml.value).unwrap();

    let frontmatter = serde_yaml::from_value::<BasicFrontmatter>(fm_value.clone()).unwrap();

    let mut styles = HashSet::new();
    const MD_STYLE: &str = include_str!("../asset/style/md.css");
    styles.insert(StrPtr(MD_STYLE));

    let mut ctx = Context {
        fm_value: fm_value.clone(),
        buf: String::new(),
        styles: &mut styles,
        h2s: Vec::new(),
    };
    layout::to_html(&frontmatter.layout, &mdast, &mut ctx);
    let Context { buf, .. } = ctx;

    let styles = styles.iter().map(|n| n.0).collect::<Vec<_>>();
    let html = template::generate_html_string(&styles, &frontmatter.title, &buf);

    (html, fm_value)
}
