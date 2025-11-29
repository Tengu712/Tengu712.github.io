//! IOを扱うモジュール
//!
//! - pages内のすべてのファイルをトラバースする
//! - Markdownファイルが見つかればその対処をmdモジュールに委譲する
//! - 各モジュールで使う汎用関数もここで定義する

use std::{
    fs,
    path::{Path, PathBuf},
};

mod md;

fn clear_dist() {
    if Path::new("./dist").exists() {
        fs::remove_dir_all("./dist").unwrap();
    }
}

fn replace_root_with_dist(path: &Path) -> PathBuf {
    let mut new_path = PathBuf::from("dist");
    new_path.extend(path.components().skip(1));
    new_path
}

fn ensure_dir(path: &Path) {
    if let Some(parent) = path.parent() {
        fs::create_dir_all(parent).unwrap();
    }
}

fn copy_publics() {
    let file_paths = glob::glob("./public/**/*")
        .unwrap()
        .map(|n| n.unwrap())
        .collect::<Vec<_>>();
    for file_path in file_paths {
        let mut dst_path = PathBuf::from("dist");
        dst_path.extend(file_path.components().skip(1));
        ensure_dir(&dst_path);
        fs::copy(file_path, dst_path).unwrap();
    }
}

fn main() {
    clear_dist();

    let file_paths = glob::glob("./pages/**/*")
        .unwrap()
        .map(|n| n.unwrap())
        .collect::<Vec<_>>();

    for file_path in file_paths {
        if !file_path.is_file() {
            continue;
        }
        if let Some(ext) = file_path.extension()
            && ext == "md"
        {
            let dst_path = md::to_index_html_path(&file_path);
            let dst_path = replace_root_with_dist(&dst_path);
            let content = fs::read_to_string(file_path).unwrap();
            let content = md::convert_to_html(&content);
            ensure_dir(&dst_path);
            fs::write(dst_path, content).unwrap();
        } else {
            let dst_path = replace_root_with_dist(&file_path);
            ensure_dir(&dst_path);
            fs::copy(file_path, dst_path).unwrap();
        }
    }

    copy_publics();
}
