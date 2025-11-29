//! レイアウトに関するモジュール
//!
//! - 適切にレイアウトの変換関数を呼び出すだけ
//! - ついでに共有して使われるレイアウト構成コンポーネントをここで定義する

use super::Context;

use markdown::mdast::Node;

mod basic;
mod post;

const TRIAD_STYLE: &str = include_str!("../../asset/style/triad.css");

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

pub fn to_html(layout: &str, content: &Node, ctx: &mut Context) {
    if layout == "basic" {
        basic::to_html(content, ctx);
    } else if layout == "post" {
        post::to_html(content, ctx);
    }
}
