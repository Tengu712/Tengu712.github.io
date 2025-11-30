//! 強制的に作られるファイルを作るモジュール

use crate::{embedded::*, strutil::StrPtr, template};
use serde::Deserialize;
use serde_yaml::Value;
use std::collections::HashSet;

#[derive(Deserialize)]
struct PostMeta {
    title: String,
    genre: String,
    tags: Vec<String>,
    date: String,
}

pub fn generate_posts_index_page(metas: Vec<(String, Value)>) -> String {
    let mut styles = HashSet::new();
    styles.insert(StrPtr(style::MD));
    styles.insert(StrPtr(style::TRIAD));
    styles.insert(StrPtr(style::HEADER));
    styles.insert(StrPtr(style::FOOTER));
    styles.insert(StrPtr(style::META));

    let mut buf = String::new();

    template::generate_html_string(&HashSet::new(), "天狗会議録", "")
}
