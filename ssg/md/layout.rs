//! レイアウトごとのtriad-center内の生成に関するモジュール

use super::Styles;
use crate::{embedded::*, md::convert, strutil::StrPtr};
use markdown::mdast::Node;
use serde::Deserialize;
use serde_yaml::Value;

pub mod basic {
    use super::*;

    pub fn to_html(mdast: &Node, styles: &mut Styles) -> String {
        let mut buf = String::new();
        convert::mdast_to_html(mdast, &mut buf, styles);
        buf
    }
}

pub mod article {
    use crate::component;

    use super::*;

    #[derive(Deserialize)]
    struct FrontMatter {
        title: String,
        genre: String,
        tags: Vec<String>,
        date: String,
    }

    pub fn to_html(mdast: &Node, value: &Value, styles: &mut Styles) -> String {
        let mut buf = String::new();
        let fm = serde_yaml::from_value::<FrontMatter>(value.clone()).unwrap();

        styles.insert(StrPtr(style::POST));
        styles.insert(StrPtr(style::META));

        // icon
        buf.push_str("<div class=\"catch-icon\">");
        if fm.genre == "devenv" {
            buf.push_str(icon::WRENCH);
        } else if fm.genre == "prog" {
            buf.push_str(icon::COMMAND_LINE);
        } else if fm.genre == "experiment" {
            buf.push_str(icon::BEAKER);
        } else if fm.genre == "essay" {
            buf.push_str(icon::PENCIL_SQUARE);
        } else if fm.genre == "release" {
            buf.push_str(icon::ROCKET_LAUNCH);
        } else {
            panic!("ジャンル{}はサポートしてないよ", fm.genre);
        }
        buf.push_str("</div>");

        // title
        buf.push_str("<h1>");
        buf.push_str(&fm.title);
        buf.push_str("</h1>");

        // meta
        component::push_meta(&mut buf, styles, &fm.genre, &fm.tags, &fm.date);

        // content
        convert::mdast_to_html(mdast, &mut buf, styles);

        // tombstone
        buf.push_str("<p style=\"text-align: right\">■</p>");

        buf
    }
}
