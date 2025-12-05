//! 強制的に作られるファイルを作るモジュール

use crate::{
    component,
    embedded::*,
    strutil::StrPtr,
    template::{self, H2s, OGPInfo, Styles},
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
        buf.push_str(&format!(
            "<a href=\"/articles/{id}\" style=\"text-decoration: none !important\">{}</a>",
            meta.title
        ));
        component::push_meta(&mut buf, &mut styles, &meta.genre, &meta.tags, &meta.date);
        buf.push_str("</div>");
    }
    buf.push_str(FILTER_SCRIPT);

    let ogp = OGPInfo {
        otype: "website".to_string(),
        url: "https://skdassoc.com/".to_string(),
    };
    template::generate_basic_html(ogp, styles, "天狗会議録", &buf, H2s::new())
}

#[derive(Deserialize)]
struct ScrapMeta {
    title: String,
    topic: String,
    tags: Vec<String>,
}

pub fn generate_scraps_index_html(metas: Vec<(String, Value)>) -> String {
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
                document.querySelector('h1').insertAdjacentElement('afterend', display);\
            }\
        </script>\
    ";

    let mut buf = String::new();
    let mut styles = Styles::new();
    let mut metas = metas
        .into_iter()
        .map(|(id, value)| (id, serde_yaml::from_value::<ScrapMeta>(value).unwrap()))
        .collect::<Vec<_>>();

    styles.insert(StrPtr(style::SCRAPS_INDEX));
    metas.sort_by(|(_, meta1), (_, meta2)| meta1.topic.cmp(&meta2.topic));

    buf.push_str("<h1>Scraps</h1>");
    for (id, meta) in metas {
        buf.push_str("<div class=\"card\">");
        buf.push_str(&format!(
            "<a href=\"/scraps/{id}\" style=\"text-decoration: none !important\">{}</a>",
            meta.title
        ));
        component::push_scrap_meta(&mut buf, &mut styles, &meta.topic, &meta.tags);
        buf.push_str("</div>");
    }
    buf.push_str(FILTER_SCRIPT);

    let ogp = OGPInfo {
        otype: "article".to_string(),
        url: "https://skdassoc.com/scraps/".to_string(),
    };
    template::generate_basic_html(ogp, styles, "Scraps", &buf, H2s::new())
}

pub fn generate_404_html() -> String {
    const CONTENT: &str = "\
        <div>ないよ</div>\
        <script>\
            const curPath = window.location.pathname;\
            if (curPath.startsWith('/posts/')) {\
                const newPath = curPath.replace('/posts/', '/articles/');\
                window.location.href = newPath;\
            }\
        </script>\
    ";
    let ogp = OGPInfo {
        otype: "article".to_string(),
        url: "https://skdassoc.com/404.html".to_string(),
    };
    template::generate_basic_html(ogp, Styles::new(), "ぺーじのっとふぁうんと", CONTENT, H2s::new())
}
