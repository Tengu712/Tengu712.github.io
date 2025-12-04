//! コンポーネントに関するモジュール
//!
//! - crate::embedded::style単体でcssを入れられるけど、こっちを使うこと

use crate::{embedded::style, strutil::StrPtr};
use std::collections::HashSet;

pub fn push_meta(
    buf: &mut String,
    styles: &mut HashSet<StrPtr>,
    genre: &str,
    tags: &Vec<String>,
    date: &str,
) {
    styles.insert(StrPtr(style::META));
    buf.push_str("<div class=\"meta\">");
    buf.push_str(&format!("<a href=\"/?filter={}\">${0}</a>", genre));
    for tag in tags {
        buf.push_str(&format!("<a href=\"/?filter={}\">#{0}</a>", tag));
    }
    buf.push_str(&format!("<span>{}</span>", date));
    buf.push_str("</div>");
}

pub fn push_scrap_meta(
    buf: &mut String,
    styles: &mut HashSet<StrPtr>,
    topic: &str,
    tags: &Vec<String>,
) {
    styles.insert(StrPtr(style::SCRAP_META));
    buf.push_str("<div class=\"scrap-meta\">");
    buf.push_str(&format!("<a href=\"/scraps/?filter={}\">${0}</a>", topic));
    for tag in tags {
        buf.push_str(&format!("<a href=\"/scraps/?filter={}\">#{0}</a>", tag));
    }
    buf.push_str("</div>");
}
