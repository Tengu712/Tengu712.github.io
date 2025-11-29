//! Markdown文字列からbasicレイアウトでbodyを作成するモジュール

use super::*;
use crate::{md::convert, strutil::StrPtr};

pub fn to_html(content: &Node, ctx: &mut Context) {
    ctx.styles.insert(StrPtr(TRIAD_STYLE));
    ctx.styles.insert(StrPtr(HEADER_STYLE));
    ctx.styles.insert(StrPtr(FOOTER_STYLE));

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
