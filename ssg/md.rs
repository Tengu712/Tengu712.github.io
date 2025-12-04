//! Markdown文字列をHTML文字列に変換するモジュール

use crate::template::{self, *};
use markdown::{
    Constructs, ParseOptions,
    mdast::{Node, Yaml},
};
use serde_yaml::Value;

mod convert;
mod layout;

pub enum Layout {
    Basic,
    Article,
    Scrap,
}

fn parse(content: &str) -> (Node, Value) {
    let options = ParseOptions {
        constructs: Constructs {
            code_indented: false,
            frontmatter: true,
            gfm_strikethrough: true,
            gfm_table: true,
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

fn extract_frontmetter_yaml(mdast: &Node) -> &Yaml {
    let Node::Root(root) = mdast else {
        panic!("Rootじゃないやん: {:?}", mdast.position());
    };
    let Some(Node::Yaml(yaml)) = root.children.first() else {
        panic!("frontmatterが書かれてないやん: {:?}", mdast.position());
    };
    yaml
}

fn collect_h2s(mdast: &Node) -> H2s {
    let Node::Root(root) = mdast else {
        panic!("Rootじゃねえじゃん");
    };
    let mut h2s = Vec::new();
    for node in &root.children {
        let Node::Heading(h) = node else {
            continue;
        };
        if h.depth != 2 {
            continue;
        }
        if h.children.len() != 1 {
            panic!("h2に変なもんいれんな: {:?}", node);
        }
        let Some(Node::Text(t)) = h.children.first() else {
            panic!("h2に変なもんいれんな: {:?}", node);
        };
        h2s.push((t.value.clone(), h.position.as_ref().unwrap().start.line));
    }
    h2s
}

pub fn to_html(mdtxt: &str, layout: Layout, url: String) -> (String, Value) {
    let (mdast, value) = parse(mdtxt);

    let title = value["title"].as_str().unwrap();
    let index = value["index"].as_bool();

    let mut styles = Styles::new();

    let content = match layout {
        Layout::Basic => layout::basic::to_html(&mdast, &mut styles),
        Layout::Article => layout::article::to_html(&mdast, &value, &mut styles),
        Layout::Scrap => layout::scrap::to_html(&mdast, &value, &mut styles),
    };
    let h2s = if index == Some(false) {
        Vec::new()
    } else {
        collect_h2s(&mdast)
    };

    let ogp = OGPInfo {
        otype: "article".to_string(),
        url,
    };
    let html = template::generate_basic_html(ogp, styles, title, &content, h2s);

    (html, value)
}
