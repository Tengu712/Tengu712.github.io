//! <Center></Center>

use markdown::mdast::MdxJsxFlowElement;
use super::*;

pub fn center(n: &MdxJsxFlowElement, buf: &mut String, styles: &mut Styles) {
    buf.push_str("<div style=\"text-align: center\">");
    mdasts_to_html(&n.children, buf, styles);
    buf.push_str("</div>");
}
