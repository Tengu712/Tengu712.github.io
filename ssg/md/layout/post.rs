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

const STYLE_PC: &str = include_str!("../../../asset/style/triad.css");

pub fn to_html(content: &Node, ctx: &mut Context) {
    ctx.styles.insert(StrPtr(STYLE_PC));
    ctx.styles.insert(StrPtr(HEADER_STYLE));
    ctx.styles.insert(StrPtr(FOOTER_STYLE));

    ctx.buf.push_str(HEADER);
    ctx.buf.push_str("<div class=\"triad\">");
    ctx.buf.push_str("<div class=\"triad-side\"></div>");
    ctx.buf.push_str("<div class=\"triad-center\">");
    ctx.buf.push_str("");
    convert::mdast_to_html(content, ctx);
    ctx.buf.push_str("</div>");
    ctx.buf.push_str("<div class=\"triad-side\">");
    // TODO: index
    ctx.buf.push_str("</div>");
    ctx.buf.push_str("</div>");
    ctx.buf.push_str(FOOTER);
}
