//! レイアウトに関するモジュール
//!
//! - 適切にレイアウトの変換関数を呼び出すだけ

use super::Context;

use markdown::mdast::Node;

mod basic;
mod post;

pub fn to_html(layout: &str, content: &Node, ctx: &mut Context) {
    if layout == "basic" {
        basic::to_html(content, ctx);
    } else if layout == "post" {
        post::to_html(content, ctx);
    }
}
