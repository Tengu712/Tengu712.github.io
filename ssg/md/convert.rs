//! mdastからHTML要素へ変換するモジュール
//!
//! - OPTIMIZE: 再帰関数でトラバースしているのでパフォーマンス悪そう
//! - コンポーネントやコード量の多くなりそうな要素は子モジュールへ

use super::{Context, Styles};

use markdown::mdast::Node;

mod code;

pub fn mdast_to_html(node: &Node, buf: &mut String, styles: &mut Styles, ctx: &mut Context) {
    match node {
        Node::Root(n) => mdasts_to_html(&n.children, buf, styles, ctx),
        Node::List(n) if n.ordered => {
            buf.push_str("<ol>");
            mdasts_to_html(&n.children, buf, styles, ctx);
            buf.push_str("</ol>");
        }
        Node::List(n) => {
            buf.push_str("<ul>");
            mdasts_to_html(&n.children, buf, styles, ctx);
            buf.push_str("</ul>");
        }
        Node::Yaml(_) => (),
        Node::InlineCode(n) => {
            buf.push_str("<code>");
            buf.push_str(&n.value);
            buf.push_str("</code>");
        }
        Node::Delete(n) => {
            buf.push_str("<del>");
            mdasts_to_html(&n.children, buf, styles, ctx);
            buf.push_str("</del>");
        }
        Node::Emphasis(n) => {
            buf.push_str("<em>");
            mdasts_to_html(&n.children, buf, styles, ctx);
            buf.push_str("</em>");
        }
        Node::Html(n) => buf.push_str(&n.value),
        Node::Image(n) => {
            buf.push_str("<img src=\"");
            buf.push_str(&n.url);
            buf.push_str("\" alt=\"");
            buf.push_str(&n.alt);
            buf.push_str("\">");
        }
        Node::Link(n) => {
            buf.push_str("<a href=\"");
            buf.push_str(&n.url);
            buf.push_str("\">");
            mdasts_to_html(&n.children, buf, styles, ctx);
            buf.push_str("</a>");
        }
        Node::Strong(n) => {
            buf.push_str("<strong>");
            mdasts_to_html(&n.children, buf, styles, ctx);
            buf.push_str("</strong>");
        }
        Node::Text(n) => buf.push_str(&n.value),
        Node::Code(n) => buf.push_str(&code::to_html(&n.value, &n.lang)),
        Node::Heading(n) => {
            match n.depth {
                1 => buf.push_str("<h1>"),
                2 => {
                    if n.children.len() != 1 {
                        panic!("h2内に変な要素入れんなや: {:?}", n.position);
                    };
                    let Node::Text(text) = &n.children[0] else {
                        panic!("h2内に変な要素入れんなや: {:?}", n.position);
                    };
                    buf.push_str(&format!("<h2 id=\"{}\">", ctx.h2s.len() + 1));
                    ctx.h2s.push(text.value.clone());
                }
                3 => buf.push_str("<h3>"),
                d => panic!("h{d}タグは認めておらん"),
            }
            mdasts_to_html(&n.children, buf, styles, ctx);
            buf.push_str(match n.depth {
                1 => "</h1>",
                2 => "</h2>",
                3 => "</h3>",
                d => panic!("h{d}タグは認めておらん"),
            });
        }
        Node::ListItem(n) => {
            buf.push_str("<li>");
            mdasts_to_html(&n.children, buf, styles, ctx);
            buf.push_str("</li>");
        }
        Node::Paragraph(n) => {
            buf.push_str("<p>");
            mdasts_to_html(&n.children, buf, styles, ctx);
            buf.push_str("</p>");
        }
        _ => unimplemented!(),
    }
}

pub fn mdasts_to_html(nodes: &[Node], buf: &mut String, styles: &mut Styles, ctx: &mut Context) {
    nodes
        .iter()
        .for_each(|node| mdast_to_html(node, buf, styles, ctx));
}
