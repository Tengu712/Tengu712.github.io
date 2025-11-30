//! IOを扱うモジュール
//!
//! - pages内のすべてのファイルをトラバースする
//! - Markdownファイルが見つかればその対処をmdモジュールに委譲する
//! - ↑の対処で集めた情報をもとにトップページを生成する
//! - publicはすべてdist直下にコピーする

use serde_yaml::Value;
use std::{
    fs,
    path::{Path, PathBuf},
};

mod component;
mod defaults;
mod embedded;
mod md;
mod strutil;
mod template;

fn is_markdown(path: &Path) -> bool {
    path.extension().is_some_and(|ext| ext == "md")
}

fn get_file_stem(path: &Path) -> String {
    path.file_stem().unwrap().to_string_lossy().to_string()
}

fn to_index_html_path(path: &Path) -> PathBuf {
    let mut path = PathBuf::from(path);
    if path.file_stem().unwrap() == "index" {
        path.set_extension("html");
    } else {
        path.set_extension("");
        path.push("index.html");
    }
    path
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

fn process_markdown_source(path: &Path) -> Value {
    let dst_path = to_index_html_path(path);
    let dst_path = replace_root_with_dist(&dst_path);
    let content = fs::read_to_string(path).unwrap();
    let (content, value) = md::to_html(&content);
    ensure_dir(&dst_path);
    fs::write(dst_path, content).unwrap();
    value
}

fn process_normal_source(path: &Path) {
    let dst_path = replace_root_with_dist(path);
    ensure_dir(&dst_path);
    fs::copy(path, dst_path).unwrap();
}

fn clear_dist() {
    if Path::new("./dist").exists() {
        fs::remove_dir_all("./dist").unwrap();
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

    let paths = glob::glob("./pages/**/*")
        .unwrap()
        .map(|n| n.unwrap())
        .collect::<Vec<_>>();

    let mut post_metas = Vec::new();

    for path in paths {
        if !path.is_file() {
            continue;
        }
        if is_markdown(&path) {
            let value = process_markdown_source(&path);
            if path.starts_with("pages/posts") {
                post_metas.push((get_file_stem(&path), value));
            }
        } else {
            process_normal_source(&path);
        }
    }

    defaults::generate_posts_index_page(post_metas);
    copy_publics();
}
