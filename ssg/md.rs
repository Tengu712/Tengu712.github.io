use super::{replace_root_with_dist, write_file};

use markdown::{Constructs, ParseOptions, mdast::Node};
use std::{
    fs,
    path::{Path, PathBuf},
};

fn mdast_to_html(node: &Node) -> String {
    match node {
        Node::Root(n) => mdasts_to_html(&n.children),
        Node::List(n) if n.ordered => format!("<ol>{}</ol>", mdasts_to_html(&n.children)),
        Node::List(n) => format!("<ul>{}</ul>", mdasts_to_html(&n.children)),
        Node::Delete(n) => format!("<del>{}</del>", mdasts_to_html(&n.children)),
        Node::Emphasis(n) => format!("<em>{}</em>", mdasts_to_html(&n.children)),
        Node::Html(n) => n.value.clone(),
        Node::Image(n) => format!("<img src=\"{}\" alt=\"{}\" >", n.url, n.alt),
        Node::Link(n) => format!("<a href=\"{}\">{}</a>", n.url, mdasts_to_html(&n.children)),
        Node::Strong(n) => format!("<strong>{}</strong>", mdasts_to_html(&n.children)),
        Node::Text(n) => n.value.clone(),
        Node::Heading(n) => format!("<h{}>{}</h{0}>", n.depth, mdasts_to_html(&n.children)),
        Node::ListItem(n) => format!("<li>{}</li>", mdasts_to_html(&n.children)),
        Node::Paragraph(n) => format!("<p>{}</p>", mdasts_to_html(&n.children)),
        _ => "".to_string(),
        // TODO:
        // _ => unimplemented!(),
    }
}

fn mdasts_to_html(node: &[Node]) -> String {
    node.iter().map(mdast_to_html).collect()
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

    // TODO: layout
    let content = mdast_to_html(&mdast);

    write_file(content.as_str(), &determine_dst_path(file_path));
}
