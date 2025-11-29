//! Markdown文字列からpostレイアウトでbodyを作成するモジュール

use super::*;
use crate::{md::convert, strutil::StrPtr};

use serde::Deserialize;

#[derive(Deserialize)]
struct FrontMatter {
    title: String,
    genre: String,
    tags: Vec<String>,
    date: String,
}

const STYLE: &str = include_str!("../../../asset/style/post.css");
const DEVENV: &str = include_str!("../../../asset/icon/heroicons-command-line.svg");

pub fn to_html(content: &Node, ctx: &mut Context) {
    let frontmatter = serde_yaml::from_value::<FrontMatter>(ctx.frontmatter_value.clone()).unwrap();

    ctx.styles.insert(StrPtr(STYLE));
    ctx.styles.insert(StrPtr(TRIAD_STYLE));
    ctx.styles.insert(StrPtr(HEADER_STYLE));
    ctx.styles.insert(StrPtr(FOOTER_STYLE));

    ctx.buf.push_str(HEADER);

    ctx.buf.push_str("<div class=\"triad\">");

    ctx.buf.push_str("<div class=\"triad-side\"></div>");

    ctx.buf.push_str("<div class=\"triad-center\">");
    ctx.buf.push_str("<div class=\"catch-icon\">");
    ctx.buf.push_str(DEVENV);
    ctx.buf.push_str("</div>");
    ctx.buf.push_str("<h1>");
    ctx.buf.push_str(&frontmatter.title);
    ctx.buf.push_str("</h1>");
    convert::mdast_to_html(content, ctx);
    ctx.buf.push_str("<p style=\"text-align: right\">■</p>");
    ctx.buf.push_str("</div>");

    ctx.buf.push_str("<div class=\"triad-side\">");
    // TODO: index
    ctx.buf.push_str("</div>");

    ctx.buf.push_str("</div>");

    ctx.buf.push_str(FOOTER);
}
