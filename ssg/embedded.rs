//! 本プログラムに埋め込まれるデータに関するモジュール
//!
//! - 主にasset内のファイル
//! - うっかり二回include_*!()するとまずいので

pub mod icon {
    pub const BEAKER: &str = include_str!("../asset/icon/heroicons-beaker.svg");
    pub const COMMAND_LINE: &str = include_str!("../asset/icon/heroicons-command-line.svg");
    pub const PENCIL_SQUARE: &str = include_str!("../asset/icon/heroicons-pencil-square.svg");
    pub const ROCKET_LAUNCH: &str = include_str!("../asset/icon/heroicons-rocket-launch.svg");
    pub const WRENCH: &str = include_str!("../asset/icon/heroicons-wrench.svg");
}

pub mod style {
    // テンプレート
    pub const BASIC: &str = include_str!("../asset/style/basic.css");

    // ページ固有
    pub const ARTICLES_INDEX: &str = include_str!("../asset/style/articles-index.css");

    // レイアウト
    pub const ARTICLE: &str = include_str!("../asset/style/article.css");

    // コンポーネント
    pub const META: &str = include_str!("../asset/style/meta.css");

    // 他
    pub const KATEX_MIN_CSS: &str = include_str!("../asset/style/katex.min.css");
}
