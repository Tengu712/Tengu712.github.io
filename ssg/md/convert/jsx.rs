use super::*;
use markdown::mdast::*;

pub enum MdxJsx<'a> {
    Flow(&'a MdxJsxFlowElement),
    Text(&'a MdxJsxTextElement),
}

fn find_jsx_attribute<'a>(attributes: &'a [AttributeContent], name: &str) -> &'a str {
    for a in attributes {
        let AttributeContent::Property(prop) = a else {
            continue;
        };
        if prop.name != name {
            continue;
        }
        return match prop.value.as_ref().unwrap() {
            AttributeValue::Expression(v) => &v.value,
            AttributeValue::Literal(v) => v,
        };
    }
    panic!("{name}がねえ: {:?}", attributes);
}

pub fn to_html(n: MdxJsx, buf: &mut String, styles: &mut Styles) {
    let (name, children) = match n {
        MdxJsx::Flow(n) => (n.name.as_ref().unwrap(), &n.children),
        MdxJsx::Text(n) => (n.name.as_ref().unwrap(), &n.children),
    };
    if name == "Center" {
        buf.push_str("<div style=\"text-align: center\">");
        mdasts_to_html(children, buf, styles);
        buf.push_str("</div>");
    } else if name == "Details" {
        buf.push_str("<details><summary>");
        let atts = match n {
            MdxJsx::Flow(n) => &n.attributes,
            MdxJsx::Text(n) => &n.attributes,
        };
        buf.push_str(find_jsx_attribute(atts, "summary"));
        buf.push_str("</summary>");
        mdasts_to_html(children, buf, styles);
        buf.push_str("</details>");
    } else if name == "Small" {
        buf.push_str("<div style=\"font-size: 14px; color: #777\"><p>");
        mdasts_to_html(children, buf, styles);
        buf.push_str("</p></div>");
    } else if name == "DoubleImages" {
        let (src1, src2) = match n {
            MdxJsx::Flow(n) => (
                find_jsx_attribute(&n.attributes, "src1"),
                find_jsx_attribute(&n.attributes, "src2"),
            ),
            MdxJsx::Text(n) => (
                find_jsx_attribute(&n.attributes, "src1"),
                find_jsx_attribute(&n.attributes, "src2"),
            ),
        };
        buf.push_str("<div class=\"double-imgs-container\"><img src=\"");
        buf.push_str(src1);
        buf.push_str("\"><img src=\"");
        buf.push_str(src2);
        buf.push_str("\"></div>");
    } else if name == "Tombstone" {
        buf.push_str("<p style=\"text-align: right\">■</p>");
    } else {
        panic!("{name}コンポーネントはねえよ");
    }
}
