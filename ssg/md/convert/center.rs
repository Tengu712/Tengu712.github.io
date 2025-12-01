//! <Center></Center>

use super::*;
use markdown::mdast::MdxJsxFlowElement;

pub fn to_html(n: &MdxJsxFlowElement, buf: &mut String, styles: &mut Styles) {
    buf.push_str("<div style=\"text-align: center\">");
    mdasts_to_html(&n.children, buf, styles);
    buf.push_str("</div>");
}
