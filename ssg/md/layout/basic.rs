//! Markdown文字列からbasicレイアウトでbodyを作成するモジュール

use super::*;
use crate::{component, md::convert};

pub fn to_html(mdast: &Node, _: &Value, buf: &mut String, styles: &mut Styles, ctx: &mut Context) {
    component::push_header(buf, styles);
    component::push_triad(
        buf,
        styles,
        component::skip,
        |buf, styles| convert::mdast_to_html(mdast, buf, styles, ctx),
        component::skip,
    );
    component::push_footer(buf, styles);
}
