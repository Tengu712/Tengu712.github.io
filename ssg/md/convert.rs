//! mdastからHTML要素へ変換するモジュール
//!
//! - OPTIMIZE: 再帰関数でトラバースしているのでパフォーマンス悪そう
//! - コンポーネントやコード量の多くなりそうな要素は子モジュールへ

use super::Styles;
use crate::{embedded::style, strutil::StrPtr};
use markdown::mdast::{
    AttributeContent, AttributeValue, MdxJsxFlowElement, MdxJsxTextElement, Node,
};

mod code;
mod table;

enum MdxJsx<'a> {
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

fn component_to_html(n: MdxJsx, buf: &mut String, styles: &mut Styles) {
    let (name, children) = match n {
        MdxJsx::Flow(n) => (n.name.as_ref().unwrap(), &n.children),
        MdxJsx::Text(n) => (n.name.as_ref().unwrap(), &n.children),
    };
    if name == "Center" {
        buf.push_str("<div style=\"text-align: center\">");
        mdasts_to_html(children, buf, styles);
        buf.push_str("</div>");
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

pub fn mdast_to_html(node: &Node, buf: &mut String, styles: &mut Styles) {
    match node {
        Node::Root(n) => mdasts_to_html(&n.children, buf, styles),
        Node::Blockquote(n) => {
            buf.push_str("<blockquote>");
            mdasts_to_html(&n.children, buf, styles);
            buf.push_str("</blockquote>");
        }
        Node::MdxJsxFlowElement(n) => component_to_html(MdxJsx::Flow(n), buf, styles),
        Node::List(n) if n.ordered => {
            buf.push_str("<ol>");
            mdasts_to_html(&n.children, buf, styles);
            buf.push_str("</ol>");
        }
        Node::List(n) => {
            buf.push_str("<ul>");
            mdasts_to_html(&n.children, buf, styles);
            buf.push_str("</ul>");
        }
        Node::Yaml(_) => (),
        Node::InlineCode(n) => {
            buf.push_str("<code>");
            buf.push_str(&n.value);
            buf.push_str("</code>");
        }
        Node::InlineMath(n) => {
            styles.insert(StrPtr(style::KATEX_MIN_CSS));
            buf.push_str(&katex::render(&n.value).unwrap());
        }
        Node::Delete(n) => {
            buf.push_str("<del>");
            mdasts_to_html(&n.children, buf, styles);
            buf.push_str("</del>");
        }
        Node::Emphasis(n) => {
            buf.push_str("<em>");
            mdasts_to_html(&n.children, buf, styles);
            buf.push_str("</em>");
        }
        Node::Html(n) => buf.push_str(&n.value),
        Node::Image(n) => {
            buf.push_str("<div class=\"img-container\">");
            buf.push_str("<img src=\"");
            buf.push_str(&n.url);
            buf.push_str("\">");
            if !n.alt.is_empty() {
                buf.push_str("<label><i>");
                buf.push_str(&n.alt);
                buf.push_str("</i></label>");
            }
            buf.push_str("</div>");
        }
        Node::MdxJsxTextElement(n) => component_to_html(MdxJsx::Text(n), buf, styles),
        Node::Link(n) => {
            buf.push_str("<a href=\"");
            buf.push_str(&n.url);
            buf.push_str("\">");
            mdasts_to_html(&n.children, buf, styles);
            buf.push_str("</a>");
        }
        Node::Strong(n) => {
            buf.push_str("<strong>");
            mdasts_to_html(&n.children, buf, styles);
            buf.push_str("</strong>");
        }
        Node::Text(n) => buf.push_str(&n.value),
        Node::Code(n) => buf.push_str(&code::to_html(&n.value, &n.lang)),
        Node::Math(n) => {
            styles.insert(StrPtr(style::KATEX_MIN_CSS));
            let opts = katex::Opts::builder().display_mode(true).build().unwrap();
            buf.push_str(&katex::render_with_opts(&n.value, opts).unwrap());
        }
        Node::Heading(n) => {
            match n.depth {
                1 => buf.push_str("<h1>"),
                2 => {
                    let id = n.position.as_ref().unwrap().start.line;
                    buf.push_str(&format!("<h2 id=\"{id}\">"));
                }
                3 => buf.push_str("<h3>"),
                d => panic!("h{d}タグは認めておらん"),
            }
            mdasts_to_html(&n.children, buf, styles);
            buf.push_str(match n.depth {
                1 => "</h1>",
                2 => "</h2>",
                3 => "</h3>",
                d => panic!("h{d}タグは認めておらん"),
            });
        }
        Node::Table(n) => table::to_html(n, buf, styles),
        Node::ListItem(n) => {
            buf.push_str("<li>");
            mdasts_to_html(&n.children, buf, styles);
            buf.push_str("</li>");
        }
        Node::Paragraph(n) => {
            buf.push_str("<p>");
            mdasts_to_html(&n.children, buf, styles);
            buf.push_str("</p>");
        }
        _ => panic!("unimplemented ast: {:?}", node),
    }
}

pub fn mdasts_to_html(nodes: &[Node], buf: &mut String, styles: &mut Styles) {
    nodes
        .iter()
        .for_each(|node| mdast_to_html(node, buf, styles));
}
