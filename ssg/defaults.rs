//! 強制的に作られるファイルを作るモジュール

use crate::{component, embedded::*, strutil::StrPtr, template};
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
    let mut buf = String::new();
    let mut styles = HashSet::new();

    styles.insert(StrPtr(style::MD));
    styles.insert(StrPtr(style::POSTS_INDEX));

    let mut metas = metas
        .into_iter()
        .map(|(id, value)| (id, serde_yaml::from_value::<PostMeta>(value).unwrap()))
        .collect::<Vec<_>>();
    metas.sort_by(|(_, meta1), (_, meta2)| meta2.date.cmp(&meta1.date));

    component::push_header(&mut buf, &mut styles);
    component::push_triad(
        &mut buf,
        &mut styles,
        component::skip,
        |buf, styles| {
            buf.push_str("<img src=\"/catch.png\" class=\"catch\">");
            for (id, meta) in metas {
                buf.push_str("<div class=\"card\">");
                buf.push_str(&format!("<a href=\"/posts/{id}\">{}</a>", meta.title));
                component::push_meta(buf, styles, &meta.genre, &meta.tags, &meta.date);
                buf.push_str("</div>");
            }
        },
        component::skip,
    );
    component::push_footer(&mut buf, &mut styles);

    template::generate_html_string(&styles, "天狗会議録", &buf)
}
