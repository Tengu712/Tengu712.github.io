//! scrapレイアウトでtriad-center内のHTMLを生成するモジュール

use super::*;
use crate::component;

#[derive(Deserialize)]
struct FrontMatter {
    title: String,
    topic: String,
    tags: Vec<String>,
}

pub fn to_html(mdast: &Node, value: &Value, styles: &mut Styles) -> String {
    let mut buf = String::new();
    let fm = serde_yaml::from_value::<FrontMatter>(value.clone()).unwrap();

    styles.insert(StrPtr(style::ARTICLE));

    // title
    buf.push_str("<h1>");
    buf.push_str(&fm.title);
    buf.push_str("</h1>");

    // meta
    component::push_scrap_meta(&mut buf, styles, &fm.topic, &fm.tags);

    // content
    convert::mdast_to_html(mdast, &mut buf, styles);

    // tombstone
    buf.push_str("<p style=\"text-align: right\">■</p>");

    buf
}
