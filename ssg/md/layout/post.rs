//! Markdown文字列からpostレイアウトでbodyを作成するモジュール

use crate::{
    md::{self, component::*},
    strutil::StrPtr,
};

use markdown::mdast::Node;
use std::collections::HashSet;

const STYLE_PC: &str = include_str!("../../../asset/style/triad.css");

pub fn to_html_post(content: &Node, styles: &mut HashSet<StrPtr>, buf: &mut String) {
    styles.insert(StrPtr(STYLE_PC));
    styles.insert(StrPtr(HEADER_STYLE));
    styles.insert(StrPtr(FOOTER_STYLE));

    buf.push_str(HEADER);
    buf.push_str("<div class=\"triad\">");
    buf.push_str("<div class=\"triad-side\"></div>");
    buf.push_str("<div class=\"triad-center\">");
    buf.push_str("");
    md::mdast_to_html(content, buf);
    buf.push_str("</div>");
    buf.push_str("<div class=\"triad-side\">");
    // TODO: index
    buf.push_str("</div>");
    buf.push_str("</div>");
    buf.push_str(FOOTER);
}
