//! Markdown文字列をHTML文字列に変換するモジュール
//!
//! - 変換に限らずMarkdownに関するものは取り敢えずこのモジュールの範囲
//! - 実際はlayoutモジュールに委譲する

use crate::{embedded::*, strutil::StrPtr, template};

use markdown::{
    Constructs, ParseOptions,
    mdast::{Node, Yaml},
};
use serde_yaml::Value;
use std::collections::HashSet;

mod convert;
mod layout;

type Styles = HashSet<StrPtr>;

struct Context {
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

fn parse(content: &str) -> (Node, Value) {
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
    let yaml = extract_frontmetter_yaml(&mdast);
    let value = serde_yaml::from_str::<Value>(&yaml.value).unwrap();
    (mdast, value)
}

fn to_html_body(mdast: &Node, value: &Value, layout: &str) -> (String, Styles) {
    let mut buf = String::new();
    let mut styles = Styles::new();
    let mut ctx = Context { h2s: Vec::new() };
    styles.insert(StrPtr(style::MD));
    layout::to_html(layout, mdast, value, &mut buf, &mut styles, &mut ctx);
    (buf, styles)
}

pub fn to_html(content: &str) -> (String, Value) {
    let (mdast, value) = parse(content);
    let title = value["title"].as_str().unwrap();
    let layout = value["layout"].as_str().unwrap();
    let (body, styles) = to_html_body(&mdast, &value, layout);
    let html = template::generate_html_string(&styles, title, &body);
    (html, value)
}
