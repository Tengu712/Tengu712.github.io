//! レイアウトに関するモジュール
//!
//! - 適切にレイアウトの変換関数を呼び出すだけ

use super::Styles;
use markdown::mdast::Node;
use serde_yaml::Value;

mod basic;
mod post;

pub fn to_html(layout: &str, mdast: &Node, value: &Value, buf: &mut String, styles: &mut Styles) {
    if layout == "basic" {
        basic::to_html(mdast, value, buf, styles);
    } else if layout == "post" {
        post::to_html(mdast, value, buf, styles);
    }
}
