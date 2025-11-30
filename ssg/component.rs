//! コンポーネントに関するモジュール
//!
//! - crate::embedded::style単体でcssを入れられるけど、こっちを使うこと
//! - レイアウト固有コンポーネントは定義しない

use crate::{embedded::style, strutil::StrPtr};

use std::collections::HashSet;

/// コンテナ型のクロージャを渡す必要がないとき簡潔に書けるようにする空関数
pub fn skip(_: &mut String, _: &mut HashSet<StrPtr>) {}

pub fn push_triad<F1, F2, F3>(
    buf: &mut String,
    styles: &mut HashSet<StrPtr>,
    left: F1,
    center: F2,
    right: F3,
) where
    F1: FnOnce(&mut String, &mut HashSet<StrPtr>),
    F2: FnOnce(&mut String, &mut HashSet<StrPtr>),
    F3: FnOnce(&mut String, &mut HashSet<StrPtr>),
{
    styles.insert(StrPtr(style::TRIAD));
    buf.push_str("<div class=\"triad\"><div class=\"triad-side\">");
    left(buf, styles);
    buf.push_str("</div><div class=\"triad-center\">");
    center(buf, styles);
    buf.push_str("</div><div class=\"triad-side\">");
    right(buf, styles);
    buf.push_str("</div></div>");
}

pub fn push_header(buf: &mut String, styles: &mut HashSet<StrPtr>) {
    styles.insert(StrPtr(style::HEADER));
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
}

pub fn push_footer(buf: &mut String, styles: &mut HashSet<StrPtr>) {
    styles.insert(StrPtr(style::FOOTER));
    buf.push_str("<div class=\"footer\">2022-2025, Tengu712, Skydog Association</div>");
}
