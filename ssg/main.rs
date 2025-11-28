use markdown::{to_mdast, Constructs, ParseOptions};
use std::fs;

struct Page {
    body: String,
}

impl Page {
    fn from(path: &str) -> Self {
        Self {
            body: fs::read_to_string(path).unwrap(),
        }
    }
}

fn main() {
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
    println!(
        "{:?}",
        to_mdast(&Page::from("pages/index.md").body, &options).unwrap()
    );
}
