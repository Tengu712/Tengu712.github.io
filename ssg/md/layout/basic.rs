//! Markdown文字列からbasicレイアウトでbodyを作成するモジュール

use super::*;
use crate::{component, embedded::*, md::convert, strutil::StrPtr};

pub fn to_html(content: &Node, ctx: &mut Context) {
    ctx.styles.insert(StrPtr(style::TRIAD));

    component::push_header(&mut ctx.buf, &mut ctx.styles);

    ctx.buf.push_str("<div class=\"triad\">");

    ctx.buf.push_str("<div class=\"triad-side\"></div>");

    ctx.buf.push_str("<div class=\"triad-center\">");
    convert::mdast_to_html(content, ctx);
    ctx.buf.push_str("</div>");

    ctx.buf.push_str("<div class=\"triad-side\"></div>");

    ctx.buf.push_str("</div>");

    component::push_footer(&mut ctx.buf, &mut ctx.styles);
}
