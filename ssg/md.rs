use super::{replace_root_with_dist, write_file};

use markdown::{Constructs, ParseOptions, mdast::Node};
use serde::Deserialize;
use std::{
    fs,
    path::{Path, PathBuf},
};

#[derive(Deserialize)]
struct BasicFrontmatter {
    title: String,
    layout: String,
}

fn extract_frontmetter(mdast: &Node) -> BasicFrontmatter {
    let Node::Root(root) = mdast else {
        panic!("Rootじゃないやん: {:?}", mdast.position());
    };
    let Some(Node::Yaml(yaml)) = root.children.first() else {
        panic!("frontmatterが書かれてないやん: {:?}", mdast.position());
    };
    serde_yaml::from_str(&yaml.value).unwrap()
}

fn mdast_to_html(node: &Node, buf: &mut String) {
    match node {
        Node::Root(n) => mdasts_to_html(&n.children, buf),
        Node::List(n) if n.ordered => {
            buf.push_str("<ol>");
            mdasts_to_html(&n.children, buf);
            buf.push_str("</ol>");
        }
        Node::List(n) => {
            buf.push_str("<ul>");
            mdasts_to_html(&n.children, buf);
            buf.push_str("</ul>");
        }
        Node::Yaml(_) => (),
        Node::Delete(n) => {
            buf.push_str("<del>");
            mdasts_to_html(&n.children, buf);
            buf.push_str("</del>");
        }
        Node::Emphasis(n) => {
            buf.push_str("<em>");
            mdasts_to_html(&n.children, buf);
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
            mdasts_to_html(&n.children, buf);
            buf.push_str("</a>");
        }
        Node::Strong(n) => {
            buf.push_str("<strong>");
            mdasts_to_html(&n.children, buf);
            buf.push_str("</strong>");
        }
        Node::Text(n) => buf.push_str(&n.value),
        Node::Heading(n) => {
            buf.push_str(match n.depth {
                1 => "<h1>",
                2 => "<h2>",
                3 => "<h3>",
                d => panic!("h{d}タグは認めておらん"),
            });
            mdasts_to_html(&n.children, buf);
            buf.push_str(match n.depth {
                1 => "</h1>",
                2 => "</h2>",
                3 => "</h3>",
                d => panic!("h{d}タグは認めておらん"),
            });
        }
        Node::ListItem(n) => {
            buf.push_str("<li>");
            mdasts_to_html(&n.children, buf);
            buf.push_str("</li>");
        }
        Node::Paragraph(n) => {
            buf.push_str("<p>");
            mdasts_to_html(&n.children, buf);
            buf.push_str("</p>");
        }
        _ => (),
        // TODO:
        // _ => unimplemented!(),
    }
}

fn mdasts_to_html(nodes: &[Node], buf: &mut String) {
    nodes.iter().for_each(|node| mdast_to_html(node, buf));
}

fn determine_dst_path(src_path: &Path) -> PathBuf {
    let mut dst_path = replace_root_with_dist(src_path);
    if dst_path.file_stem().unwrap() == "index" {
        dst_path.set_extension("html");
    } else {
        dst_path.set_extension("");
        dst_path.push("index.html");
    }
    dst_path
}

pub fn run(file_path: &Path) {
    let content = fs::read_to_string(file_path).unwrap();

    let options = ParseOptions {
        constructs: Constructs {
            code_indented: false,
            frontmatter: true,
            html_flow: false,
            html_text: false,
            math_flow: true,
            math_text: true,
            mdx_jsx_flow: true,
            mdx_jsx_text: true,
            ..Default::default()
        },
        ..Default::default()
    };
    let mdast = markdown::to_mdast(&content, &options).unwrap();
    let frontmatter = extract_frontmetter(&mdast);

    const HTML_TITLE: &str = "\
        <!DOCTYPE html>\
        <html lang=\"ja\">\
        <head>\
            <meta charset=\"UTF-8\">\
            <meta name=\"viewport\" content=\"width=device-width\">\
            <link rel=\"icon\" href=\"/favicon.ico\">\
            <title>\
    ";
    const TITLE_BODY: &str = "\
            </title>\
        </head>\
        <body>\
    ";
    const BODY_HTML: &str = "\
        </body>\
        </html>\
    ";

    let mut html = HTML_TITLE.to_string();
    html.push_str(&frontmatter.title);
    html.push_str(TITLE_BODY);
    // TODO: layout
    mdast_to_html(&mdast, &mut html);
    html.push_str(BODY_HTML);

    write_file(&html, &determine_dst_path(file_path));
}
