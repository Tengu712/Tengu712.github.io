//! Markdown文字列からbasicレイアウトでbodyを作成するモジュール

use super::*;
use crate::{md::convert, embedded::*, strutil::StrPtr};

pub fn to_html(content: &Node, ctx: &mut Context) {
    ctx.styles.insert(StrPtr(style::TRIAD));
    ctx.styles.insert(StrPtr(style::HEADER));
    ctx.styles.insert(StrPtr(style::FOOTER));

    ctx.buf.push_str(HEADER);

    ctx.buf.push_str("<div class=\"triad\">");

    ctx.buf.push_str("<div class=\"triad-side\"></div>");

    ctx.buf.push_str("<div class=\"triad-center\">");
    convert::mdast_to_html(content, ctx);
    ctx.buf.push_str("</div>");

    ctx.buf.push_str("<div class=\"triad-side\"></div>");

    ctx.buf.push_str("</div>");

    ctx.buf.push_str(FOOTER);
}
