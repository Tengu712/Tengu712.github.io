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
