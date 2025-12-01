//! 強制的に作られるファイルを作るモジュール

use crate::{
    component,
    embedded::*,
    strutil::StrPtr,
    template::{self, H2s, Styles},
};
use serde::Deserialize;
use serde_yaml::Value;

#[derive(Deserialize)]
struct ArticleMeta {
    title: String,
    genre: String,
    tags: Vec<String>,
    date: String,
}

pub fn generate_articles_index_html(metas: Vec<(String, Value)>) -> String {
    const FILTER_SCRIPT: &str = "\
        <script>\
            const filter = new URLSearchParams(location.search).get('filter');\
            if (filter) {\
                document.querySelectorAll('.card').forEach(n => {\
                    n.style.display = n.querySelector(`a[href*=\"filter=${filter}\"]`) ? '' : 'none';\
                });\
                const display = document.createElement('div');\
                display.className = 'filter-display';\
                display.textContent = `Filtered by \"${filter}\"`;\
                document.querySelector('.catch').insertAdjacentElement('afterend', display);\
            }\
        </script>\
    ";

    let mut buf = String::new();
    let mut styles = Styles::new();
    let mut metas = metas
        .into_iter()
        .map(|(id, value)| (id, serde_yaml::from_value::<ArticleMeta>(value).unwrap()))
        .collect::<Vec<_>>();

    styles.insert(StrPtr(style::ARTICLES_INDEX));
    metas.sort_by(|(_, meta1), (_, meta2)| meta2.date.cmp(&meta1.date));

    buf.push_str("<img src=\"/catch.png\" class=\"catch\">");
    for (id, meta) in metas {
        buf.push_str("<div class=\"card\">");
        buf.push_str(&format!("<a href=\"/articles/{id}\">{}</a>", meta.title));
        component::push_meta(&mut buf, &mut styles, &meta.genre, &meta.tags, &meta.date);
        buf.push_str("</div>");
    }
    buf.push_str(FILTER_SCRIPT);

    template::generate_basic_html(styles, "天狗会議録", &buf, H2s::new())
}
