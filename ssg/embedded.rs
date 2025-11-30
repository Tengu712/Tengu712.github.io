//! 本プログラムに埋め込まれるデータに関するモジュール
//!
//! - 主にasset内のファイル
//! - うっかり二回include_*!()するとまずいので

pub mod icon {
    pub const WRENCH: &str = include_str!("../asset/icon/heroicons-wrench.svg");
    pub const COMMAND_LINE: &str = include_str!("../asset/icon/heroicons-command-line.svg");
    pub const PENCIL_SQUARE: &str = include_str!("../asset/icon/heroicons-pencil-square.svg");
}

pub mod style {
    // レイアウト共通
    pub const MD: &str = include_str!("../asset/style/md.css");

    // レイアウト
    pub const POST: &str = include_str!("../asset/style/post.css");

    // レイアウトコンポーネント
    pub const TRIAD: &str = include_str!("../asset/style/triad.css");

    // コンポーネント
    pub const FOOTER: &str = include_str!("../asset/style/footer.css");
    pub const HEADER: &str = include_str!("../asset/style/header.css");
    pub const META: &str = include_str!("../asset/style/meta.css");

    // レイアウト固有コンポーネント
    pub const INDEX: &str = include_str!("../asset/style/index.css");
}
