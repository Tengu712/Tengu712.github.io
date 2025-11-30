//! Markdown文字列からpostレイアウトでbodyを作成するモジュール

use super::*;
use crate::{md::convert, strutil::StrPtr};

use serde::Deserialize;

#[derive(Deserialize)]
struct FrontMatter {
    title: String,
    genre: String,
    tags: Vec<String>,
    date: String,
}

const STYLE: &str = include_str!("../../../asset/style/post.css");
const INDEX_STYLE: &str = include_str!("../../../asset/style/index.css");
const META_STYLE: &str = include_str!("../../../asset/style/meta.css");
const DEVENV_ICON: &str = include_str!("../../../asset/icon/heroicons-wrench.svg");
const PROG_ICON: &str = include_str!("../../../asset/icon/heroicons-command-line.svg");
const ESSAY_ICON: &str = include_str!("../../../asset/icon/heroicons-pencil-square.svg");

pub fn to_html(content: &Node, ctx: &mut Context) {
    let frontmatter = serde_yaml::from_value::<FrontMatter>(ctx.fm_value.clone()).unwrap();

    ctx.styles.insert(StrPtr(STYLE));
    ctx.styles.insert(StrPtr(INDEX_STYLE));
    ctx.styles.insert(StrPtr(META_STYLE));
    ctx.styles.insert(StrPtr(TRIAD_STYLE));
    ctx.styles.insert(StrPtr(HEADER_STYLE));
    ctx.styles.insert(StrPtr(FOOTER_STYLE));

    ctx.buf.push_str(HEADER);

    ctx.buf.push_str("<div class=\"triad\">");

    ctx.buf.push_str("<div class=\"triad-side\"></div>");

    ctx.buf.push_str("<div class=\"triad-center\">");
    ctx.buf.push_str("<div class=\"catch-icon\">");
    if frontmatter.genre == "devenv" {
        ctx.buf.push_str(DEVENV_ICON);
    } else if frontmatter.genre == "prog" {
        ctx.buf.push_str(PROG_ICON);
    } else if frontmatter.genre == "essay" {
        ctx.buf.push_str(ESSAY_ICON);
    } else {
        panic!("ジャンル{}はサポートしてないよ", frontmatter.genre);
    }
    ctx.buf.push_str("</div>");
    ctx.buf.push_str("<h1>");
    ctx.buf.push_str(&frontmatter.title);
    ctx.buf.push_str("</h1>");
    ctx.buf.push_str("<div class=\"meta\">");
    ctx.buf.push_str(&format!(
        "<a href=\"/?filter={}\">${0}</a>",
        frontmatter.genre
    ));
    for tag in &frontmatter.tags {
        ctx.buf
            .push_str(&format!("<a href=\"/?filter={}\">#{0}</a>", tag));
    }
    ctx.buf
        .push_str(&format!("<span>{}</span>", frontmatter.date));
    ctx.buf.push_str("</div>");
    convert::mdast_to_html(content, ctx);
    ctx.buf.push_str("<p style=\"text-align: right\">■</p>");
    ctx.buf.push_str("</div>");

    ctx.buf.push_str("<div class=\"triad-side\">");
    ctx.buf.push_str("<div class=\"index\">");
    ctx.buf.push_str("<span>Index</span>");
    ctx.buf.push_str("<ol>");
    for (i, h2) in ctx.h2s.iter().enumerate() {
        ctx.buf
            .push_str(&format!("<li><a href=\"#{}\">{}</a></li>", i + 1, h2));
    }
    ctx.buf.push_str("</ol>");
    ctx.buf.push_str("</div>");
    ctx.buf.push_str("</div>");

    ctx.buf.push_str("</div>");

    ctx.buf.push_str(FOOTER);
}
