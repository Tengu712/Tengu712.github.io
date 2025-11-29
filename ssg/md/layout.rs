use crate::strutil::StrPtr;

use markdown::mdast::Node;
use std::collections::HashSet;

fn to_html_post(content: &Node, styles: &mut HashSet<StrPtr>, buf: &mut String) {
    const STYLE_PC: &str = include_str!("../../asset/style/triad.css");
    styles.insert(StrPtr(STYLE_PC));

    buf.push_str("<div class=\"triad\">");
    buf.push_str("<div class=\"triad-side\"></div>");
    buf.push_str("<div class=\"triad-center\">");
    super::mdast_to_html(content, buf);
    buf.push_str("</div>");
    buf.push_str("<div class=\"triad-side\">");
    buf.push_str("</div>");
    buf.push_str("</div>");
}

pub fn to_html(layout: &str, content: &Node, styles: &mut HashSet<StrPtr>) -> String {
    let mut body = String::new();
    if layout == "basic" {
        // TODO:
        to_html_post(content, styles, &mut body);
    } else if layout == "post" {
        to_html_post(content, styles, &mut body);
    }
    body
}
