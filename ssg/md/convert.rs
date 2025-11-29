//! mdastからHTML要素へ変換するモジュール
//!
//! - OPTIMIZE: 再帰関数でトラバースしているのでパフォーマンス悪そう
//! - コンポーネントやコード量の多くなりそうな要素は子モジュールへ

use super::Context;

use markdown::mdast::Node;

mod code;

pub fn mdast_to_html(node: &Node, ctx: &mut Context) {
    match node {
        Node::Root(n) => mdasts_to_html(&n.children, ctx),
        Node::List(n) if n.ordered => {
            ctx.buf.push_str("<ol>");
            mdasts_to_html(&n.children, ctx);
            ctx.buf.push_str("</ol>");
        }
        Node::List(n) => {
            ctx.buf.push_str("<ul>");
            mdasts_to_html(&n.children, ctx);
            ctx.buf.push_str("</ul>");
        }
        Node::Yaml(_) => (),
        Node::InlineCode(n) => {
            ctx.buf.push_str("<code>");
            ctx.buf.push_str(&n.value);
            ctx.buf.push_str("</code>");
        }
        Node::Delete(n) => {
            ctx.buf.push_str("<del>");
            mdasts_to_html(&n.children, ctx);
            ctx.buf.push_str("</del>");
        }
        Node::Emphasis(n) => {
            ctx.buf.push_str("<em>");
            mdasts_to_html(&n.children, ctx);
            ctx.buf.push_str("</em>");
        }
        Node::Html(n) => ctx.buf.push_str(&n.value),
        Node::Image(n) => {
            ctx.buf.push_str("<img src=\"");
            ctx.buf.push_str(&n.url);
            ctx.buf.push_str("\" alt=\"");
            ctx.buf.push_str(&n.alt);
            ctx.buf.push_str("\">");
        }
        Node::Link(n) => {
            ctx.buf.push_str("<a href=\"");
            ctx.buf.push_str(&n.url);
            ctx.buf.push_str("\">");
            mdasts_to_html(&n.children, ctx);
            ctx.buf.push_str("</a>");
        }
        Node::Strong(n) => {
            ctx.buf.push_str("<strong>");
            mdasts_to_html(&n.children, ctx);
            ctx.buf.push_str("</strong>");
        }
        Node::Text(n) => ctx.buf.push_str(&n.value),
        Node::Code(n) => ctx.buf.push_str(&code::to_html(&n.value, &n.lang)),
        Node::Heading(n) => {
            ctx.buf.push_str(match n.depth {
                1 => "<h1>",
                2 => "<h2>",
                3 => "<h3>",
                d => panic!("h{d}タグは認めておらん"),
            });
            mdasts_to_html(&n.children, ctx);
            ctx.buf.push_str(match n.depth {
                1 => "</h1>",
                2 => "</h2>",
                3 => "</h3>",
                d => panic!("h{d}タグは認めておらん"),
            });
        }
        Node::ListItem(n) => {
            ctx.buf.push_str("<li>");
            mdasts_to_html(&n.children, ctx);
            ctx.buf.push_str("</li>");
        }
        Node::Paragraph(n) => {
            ctx.buf.push_str("<p>");
            mdasts_to_html(&n.children, ctx);
            ctx.buf.push_str("</p>");
        }
        _ => (),
        // TODO:
        // _ => unimplemented!(),
    }
}

pub fn mdasts_to_html(nodes: &[Node], ctx: &mut Context) {
    nodes.iter().for_each(|node| mdast_to_html(node, ctx));
}
