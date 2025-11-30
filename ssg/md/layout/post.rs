//! Markdown文字列からpostレイアウトでbodyを作成するモジュール

use super::*;
use crate::{component, embedded::*, md::convert, strutil::StrPtr};
use serde::Deserialize;

#[derive(Deserialize)]
struct FrontMatter {
    title: String,
    genre: String,
    tags: Vec<String>,
    date: String,
}

pub fn collect_h2s(mdast: &Node) -> Vec<(String, usize)> {
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

fn center(mdast: &Node, fm: &FrontMatter, buf: &mut String, styles: &mut Styles) {
    // icon
    buf.push_str("<div class=\"catch-icon\">");
    if fm.genre == "devenv" {
        buf.push_str(icon::WRENCH);
    } else if fm.genre == "prog" {
        buf.push_str(icon::COMMAND_LINE);
    } else if fm.genre == "essay" {
        buf.push_str(icon::PENCIL_SQUARE);
    } else {
        panic!("ジャンル{}はサポートしてないよ", fm.genre);
    }
    buf.push_str("</div>");

    // title
    buf.push_str("<h1>");
    buf.push_str(&fm.title);
    buf.push_str("</h1>");

    // TODO: meta
    buf.push_str("<div class=\"meta\">");
    buf.push_str(&format!("<a href=\"/?filter={}\">${0}</a>", fm.genre));
    for tag in &fm.tags {
        buf.push_str(&format!("<a href=\"/?filter={}\">#{0}</a>", tag));
    }
    buf.push_str(&format!("<span>{}</span>", fm.date));
    buf.push_str("</div>");

    // content
    convert::mdast_to_html(mdast, buf, styles);

    // tombstone
    buf.push_str("<p style=\"text-align: right\">■</p>");
}

pub fn right(buf: &mut String, h2s: Vec<(String, usize)>) {
    buf.push_str("<div class=\"index\">");
    buf.push_str("<span>Index</span>");
    buf.push_str("<ol>");
    for (text, id) in h2s {
        buf.push_str(&format!("<li><a href=\"#{}\">{}</a></li>", id, text));
    }
    buf.push_str("</ol>");
    buf.push_str("</div>");
}

pub fn to_html(mdast: &Node, value: &Value, buf: &mut String, styles: &mut Styles) {
    let fm = serde_yaml::from_value::<FrontMatter>(value.clone()).unwrap();
    let h2s = collect_h2s(mdast);

    styles.insert(StrPtr(style::POST));
    styles.insert(StrPtr(style::INDEX));
    styles.insert(StrPtr(style::META));

    component::push_header(buf, styles);
    component::push_triad(
        buf,
        styles,
        component::skip,
        |buf, styles| center(mdast, &fm, buf, styles),
        |buf, _| right(buf, h2s),
    );
    component::push_footer(buf, styles);
}
