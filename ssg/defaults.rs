//! 強制的に作られるファイルを作るモジュール

use std::collections::HashSet;

use crate::template;

use serde::Deserialize;
use serde_yaml::Value;

#[derive(Deserialize)]
struct PostMeta {
    title: String,
    genre: String,
    tags: Vec<String>,
    date: String,
}

pub fn generate_posts_index_page(metas: Vec<(String, Value)>) -> String {
    // TODO:
    template::generate_html_string(&HashSet::new(), "天狗会議録", "")
}
