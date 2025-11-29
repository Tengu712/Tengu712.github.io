//! 適切にレイアウトの変換関数を呼び出すモジュール

use crate::strutil::StrPtr;

use markdown::mdast::Node;
use std::collections::HashSet;

mod post;

pub fn to_html(layout: &str, content: &Node, styles: &mut HashSet<StrPtr>) -> String {
    let mut body = String::new();
    if layout == "basic" {
        // TODO:
        post::to_html_post(content, styles, &mut body);
    } else if layout == "post" {
        post::to_html_post(content, styles, &mut body);
    }
    body
}
