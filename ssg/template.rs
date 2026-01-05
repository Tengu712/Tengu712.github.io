//! テンプレートに関するモジュール
//!
//! - 情報を与えてHTML文字列を生成する
//! - テンプレートの種類ごとに関数を定義する

use crate::{embedded::style, strutil::StrPtr};
use std::collections::HashSet;

pub type Styles = HashSet<StrPtr>;
pub type H2s = Vec<(String, usize)>;

pub struct OGPInfo {
    pub otype: String,
    pub url: String,
}

impl OGPInfo {
    fn push(&self, title: &str, buf: &mut String) {
        buf.push_str(&format!("<head prefix=\"og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# {}: http://ogp.me/ns/{0}#\">", self.otype));
        buf.push_str(&format!("<title>{title}</title>"));
        buf.push_str(&format!(
            "<meta property=\"og:title\" content=\"{title}\" />"
        ));
        buf.push_str(&format!(
            "<meta property=\"og:type\" content=\"{}\" />",
            self.otype
        ));
        buf.push_str(&format!(
            "<meta property=\"og:url\" content=\"{}\" />",
            self.url
        ));
        buf.push_str(
            "<meta property=\"og:image\" content=\"https://skdassoc.com/ogp-image.png\" />",
        );
    }
}

fn push_css(css: &str, buf: &mut String) {
    let mut space_count = 0;
    for c in css.chars() {
        match c {
            '\n' => (),
            ' ' => space_count += 1,
            c if space_count == 1 => {
                buf.push(' ');
                buf.push(c);
                space_count = 0;
            }
            c => {
                buf.push(c);
                space_count = 0;
            }
        }
    }
}

pub fn generate_basic_html(
    ogp: OGPInfo,
    mut styles: Styles,
    title: &str,
    content: &str,
    h2s: H2s,
) -> String {
    const HTML_STYLE: &str = "\
        <!DOCTYPE html>\
        <html lang=\"ja\">\
        <head>\
            <meta charset=\"UTF-8\">\
            <meta name=\"viewport\" content=\"width=device-width\">\
            <link rel=\"icon\" href=\"/favicon.ico\">\
            <style>\
    ";
    const STYLE_OGP: &str = "</style>";
    const OGP_TRIAD_CENTER: &str = "\
        </head>\
        <body>\
            <div class=\"header\">\
                <a href=\"/\"><img src=\"/favicon.ico\"></a>\
                <a href=\"/\">Articles</a>\
                <a href=\"/scraps/\">Scraps</a>\
                <a href=\"/pages/\">Pages</a>\
                <a href=\"/about/\">About</a>\
            </div>\
            <div class=\"triad\">\
                <div class=\"triad-side\">\
                </div>\
                <div class=\"triad-center\">\
    ";
    const TRIAD_CENTER_TRIAD_SIDE: &str = "\
                </div>\
                <div class=\"triad-side\">\
    ";
    const INDEX_FORMER: &str = "\
                    <div class=\"index\">\
                        <span>Index</span>\
                        <ol>\
    ";
    const INDEX_LATTER: &str = "\
                        </ol>\
                    </div>\
    ";
    const TRIAD_SIDE_HTML: &str = "\
                </div>\
            </div>\
            <div class=\"footer\">\
                2022-2026, Tengu712, Skydog Association\
            </div>\
        </body>\
        </html>\
    ";

    styles.insert(StrPtr(style::BASIC));

    let mut buf = String::new();
    buf.push_str(HTML_STYLE);
    for style in styles.iter() {
        push_css(style.0, &mut buf);
    }
    buf.push_str(STYLE_OGP);
    ogp.push(title, &mut buf);
    buf.push_str(OGP_TRIAD_CENTER);
    buf.push_str(content);
    buf.push_str(TRIAD_CENTER_TRIAD_SIDE);
    if !h2s.is_empty() {
        buf.push_str(INDEX_FORMER);
        for (text, id) in h2s {
            buf.push_str(&format!("<li><a href=\"#{id}\">{text}</a></li>"));
        }
        buf.push_str(INDEX_LATTER);
    }
    buf.push_str(TRIAD_SIDE_HTML);

    buf
}
