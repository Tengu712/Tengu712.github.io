use super::{replace_root_with_dist, write_file};

use markdown::{Constructs, ParseOptions, to_mdast};
use std::{fs, path::Path};

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
    let _ = to_mdast(&content, &options).unwrap();

    write_file(content.as_str(), &replace_root_with_dist(file_path));
}
