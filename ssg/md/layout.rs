use crate::strutil::StrPtr;

use markdown::mdast::Node;
use std::collections::HashSet;

const HEADER: &str = "\
    <div class=\"header\">\
        <a href=\"/\">天狗会議録</a>\
        <a href=\"/posts/\">Posts</a>\
        <a href=\"/scraps/\">Scraps</a>\
        <a href=\"/pages/\">Pages</a>\
        <a href=\"/about/\">About</a>\
    </div>\
";
const HEADER_STYLE: &str = include_str!("../../asset/style/header.css");

const FOOTER: &str = "<div class=\"footer\">2022-2025, Tengu712, Skydog Association</div>";
const FOOTER_STYLE: &str = include_str!("../../asset/style/footer.css");

fn to_html_post(content: &Node, styles: &mut HashSet<StrPtr>, buf: &mut String) {
    const STYLE_PC: &str = include_str!("../../asset/style/triad.css");
    styles.insert(StrPtr(STYLE_PC));
    styles.insert(StrPtr(HEADER_STYLE));
    styles.insert(StrPtr(FOOTER_STYLE));

    buf.push_str(HEADER);
    buf.push_str("<div class=\"triad\">");
    buf.push_str("<div class=\"triad-side\"></div>");
    buf.push_str("<div class=\"triad-center\">");
    super::mdast_to_html(content, buf);
    buf.push_str("</div>");
    buf.push_str("<div class=\"triad-side\">");
    buf.push_str("</div>");
    buf.push_str("</div>");
    buf.push_str(FOOTER);
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
