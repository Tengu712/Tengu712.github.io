//! コンポーネントを定義するモジュール
//!
//! - あるレイアウトでしか使われないコンポーネントも
//!   汎用的なコンポーネントも全部ここ

pub const HEADER: &str = "\
    <div class=\"header\">\
        <a href=\"/\">天狗会議録</a>\
        <a href=\"/posts/\">Posts</a>\
        <a href=\"/scraps/\">Scraps</a>\
        <a href=\"/pages/\">Pages</a>\
        <a href=\"/about/\">About</a>\
    </div>\
";
pub const HEADER_STYLE: &str = include_str!("../../asset/style/header.css");

pub const FOOTER: &str = "<div class=\"footer\">2022-2025, Tengu712, Skydog Association</div>";
pub const FOOTER_STYLE: &str = include_str!("../../asset/style/footer.css");
