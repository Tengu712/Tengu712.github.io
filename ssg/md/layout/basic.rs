//! basicレイアウトでtriad-center内のHTMLを生成するモジュール

use super::*;

pub fn to_html(mdast: &Node, styles: &mut Styles) -> String {
    let mut buf = String::new();
    convert::mdast_to_html(mdast, &mut buf, styles);
    buf
}
