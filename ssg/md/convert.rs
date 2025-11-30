//! mdastからHTML要素へ変換するモジュール
//!
//! - OPTIMIZE: 再帰関数でトラバースしているのでパフォーマンス悪そう
//! - コンポーネントやコード量の多くなりそうな要素は子モジュールへ

use super::Styles;
use markdown::mdast::Node;

mod code;
mod center;

pub fn mdast_to_html(node: &Node, buf: &mut String, styles: &mut Styles) {
    match node {
        Node::Root(n) => mdasts_to_html(&n.children, buf, styles),
        Node::MdxJsxFlowElement(n) => {
            let name = n.name.as_ref().unwrap();
            if name == "Center" {
                center::center(n, buf, styles);
            } else {
                panic!("{name}コンポーネントはねえよ");
            }
        }
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
        // TODO:
        Node::InlineMath(_) => (),
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
        _ => unimplemented!(),
    }
}

pub fn mdasts_to_html(nodes: &[Node], buf: &mut String, styles: &mut Styles) {
    nodes
        .iter()
        .for_each(|node| mdast_to_html(node, buf, styles));
}
