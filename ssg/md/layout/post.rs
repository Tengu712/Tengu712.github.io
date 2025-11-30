//! Markdown文字列からpostレイアウトでbodyを作成するモジュール

use super::*;
use crate::{component, embedded::*, md::convert, strutil::StrPtr};

use serde::Deserialize;

#[derive(Deserialize)]
struct FrontMatter {
    title: String,
    genre: String,
    tags: Vec<String>,
    date: String,
}

fn center(
    mdast: &Node,
    fm: &FrontMatter,
    buf: &mut String,
    styles: &mut Styles,
    ctx: &mut Context,
) {
    // icon
    buf.push_str("<div class=\"catch-icon\">");
    if fm.genre == "devenv" {
        buf.push_str(icon::WRENCH);
    } else if fm.genre == "prog" {
        buf.push_str(icon::COMMAND_LINE);
    } else if fm.genre == "essay" {
        buf.push_str(icon::PENCIL_SQUARE);
    } else {
        panic!("ジャンル{}はサポートしてないよ", fm.genre);
    }
    buf.push_str("</div>");

    // title
    buf.push_str("<h1>");
    buf.push_str(&fm.title);
    buf.push_str("</h1>");

    // TODO: meta
    buf.push_str("<div class=\"meta\">");
    buf.push_str(&format!("<a href=\"/?filter={}\">${0}</a>", fm.genre));
    for tag in &fm.tags {
        buf.push_str(&format!("<a href=\"/?filter={}\">#{0}</a>", tag));
    }
    buf.push_str(&format!("<span>{}</span>", fm.date));
    buf.push_str("</div>");

    // content
    convert::mdast_to_html(mdast, buf, styles, ctx);

    // tombstone
    buf.push_str("<p style=\"text-align: right\">■</p>");
}

pub fn to_html(
    mdast: &Node,
    value: &Value,
    buf: &mut String,
    styles: &mut Styles,
    ctx: &mut Context,
) {
    let frontmatter = serde_yaml::from_value::<FrontMatter>(value.clone()).unwrap();

    styles.insert(StrPtr(style::POST));
    styles.insert(StrPtr(style::INDEX));
    styles.insert(StrPtr(style::META));

    component::push_header(buf, styles);
    component::push_triad(
        buf,
        styles,
        component::skip,
        |buf, styles| center(mdast, &frontmatter, buf, styles, ctx),
        component::skip,
    );
    component::push_footer(buf, styles);

    // TODO: index
    // buf.push_str("<div class=\"index\">");
    // buf.push_str("<span>Index</span>");
    // buf.push_str("<ol>");
    // for (i, h2) in ctx.h2s.iter().enumerate() {
    //     buf.push_str(&format!("<li><a href=\"#{}\">{}</a></li>", i + 1, h2));
    // }
    // buf.push_str("</ol>");
    // buf.push_str("</div>");
}
