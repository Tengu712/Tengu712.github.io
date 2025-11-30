//! コンポーネントに関するモジュール
//!
//! - crate::embedded::style単体でcssを入れられるけど、こっちを使うこと

use crate::{embedded::style, strutil::StrPtr};

use std::collections::HashSet;

pub fn push_header(buf: &mut String, styles: &mut HashSet<StrPtr>) {
    buf.push_str(
        "\
        <div class=\"header\">\
            <a href=\"/\"><img src=\"/favicon.ico\"></a>\
            <a href=\"/posts/\">Posts</a>\
            <a href=\"/scraps/\">Scraps</a>\
            <a href=\"/pages/\">Pages</a>\
            <a href=\"/about/\">About</a>\
        </div>\
    ",
    );
    styles.insert(StrPtr(style::HEADER));
}

pub fn push_footer(buf: &mut String, styles: &mut HashSet<StrPtr>) {
    buf.push_str("<div class=\"footer\">2022-2025, Tengu712, Skydog Association</div>");
    styles.insert(StrPtr(style::FOOTER));
}
