//! 本ホームページで作られるすべてHTMLの共通部分に関するモジュール

use crate::strutil::StrPtr;
use std::collections::HashSet;

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

pub fn generate_html_string(styles: &HashSet<StrPtr>, title: &str, body: &str) -> String {
    const HTML_STYLE: &str = "\
        <!DOCTYPE html>\
        <html lang=\"ja\">\
        <head>\
            <meta charset=\"UTF-8\">\
            <meta name=\"viewport\" content=\"width=device-width\">\
            <link rel=\"icon\" href=\"/favicon.ico\">\
            <style>\
    ";
    const STYLE_TITLE: &str = "\
            </style>\
            <title>\
    ";
    const TITLE_BODY: &str = "\
            </title>\
        </head>\
        <body>\
    ";
    const BODY_HTML: &str = "\
        </body>\
        </html>\
    ";

    let mut buf = String::new();
    buf.push_str(HTML_STYLE);
    for style in styles.iter() {
        push_css(style.0, &mut buf);
    }
    buf.push_str(STYLE_TITLE);
    buf.push_str(title);
    buf.push_str(TITLE_BODY);
    buf.push_str(body);
    buf.push_str(BODY_HTML);
    buf
}
