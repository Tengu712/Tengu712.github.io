//! IOを扱うモジュール
//!
//! - pages内のファイルをトラバースする
//! - pages内のディレクトリ構成によってどのレイアウトを用いるか勝手に判断する
//! - Markdownファイル以外は単にコピーする
//! - Markdownファイルはその対処をmdモジュールに委譲する
//! - ↑で集めた情報をもとにインデックスページを生成する
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

use md::Layout;

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

fn to_url(path: &Path) -> String {
    let url = path.strip_prefix("dist").unwrap();
    let url = url.with_extension("");
    let mut url = url
        .components()
        .map(|n| n.as_os_str().to_str().unwrap())
        .collect::<Vec<_>>();
    if let Some(n) = url.last()
        && *n == "index"
    {
        url.pop();
    }
    format!("https://skdassoc.com/{}/", url.join("/"))
}

fn ensure_dir(path: &Path) {
    if let Some(parent) = path.parent() {
        fs::create_dir_all(parent).unwrap();
    }
}

fn process_markdown_source(path: &Path, layout: Layout) -> Value {
    let dst_path = to_index_html_path(path);
    let dst_path = replace_root_with_dist(&dst_path);
    let content = fs::read_to_string(path).unwrap();
    let (html, value) = md::to_html(&content, layout, to_url(&dst_path));
    ensure_dir(&dst_path);
    fs::write(dst_path, html).unwrap();
    value
}

fn process_normal_source(path: &Path) {
    let dst_path = replace_root_with_dist(path);
    ensure_dir(&dst_path);
    fs::copy(path, dst_path).unwrap();
}

fn clear_dist() {
    if Path::new("dist").exists() {
        fs::remove_dir_all("dist").unwrap();
    }
}

fn generate_articles_and_index() {
    let metas = glob::glob("pages/articles/*.md")
        .unwrap()
        .map(|p| {
            let p = p.unwrap();
            let id = get_file_stem(&p);
            let value = process_markdown_source(&p, Layout::Article);
            (id, value)
        })
        .collect::<Vec<_>>();
    fs::write(
        "dist/index.html",
        defaults::generate_articles_index_html(metas),
    )
    .unwrap();
}

fn generate_scraps_and_index() {
    let metas = glob::glob("pages/scraps/*.md")
        .unwrap()
        .map(|p| {
            let p = p.unwrap();
            let id = get_file_stem(&p);
            let value = process_markdown_source(&p, Layout::Scrap);
            (id, value)
        })
        .collect::<Vec<_>>();
    fs::write(
        "dist/scraps/index.html",
        defaults::generate_scraps_index_html(metas),
    )
    .unwrap();
}

fn generate_pages() {
    glob::glob("pages/pages/**/*").unwrap().for_each(|p| {
        let p = p.unwrap();
        if !p.is_file() {
            return;
        }
        if is_markdown(&p) {
            process_markdown_source(&p, Layout::Basic);
        } else {
            process_normal_source(&p);
        }
    });
}

fn generate_about() {
    process_markdown_source(Path::new("pages/about/index.md"), Layout::Basic);
}

fn copy_publics() {
    glob::glob("public/**/*").unwrap().for_each(|src| {
        let src = src.unwrap();
        if !src.is_file() {
            return;
        }
        let dst = replace_root_with_dist(&src);
        ensure_dir(&dst);
        fs::copy(&src, &dst).unwrap();
    });
}

fn main() {
    clear_dist();
    generate_articles_and_index();
    generate_scraps_and_index();
    generate_pages();
    generate_about();
    copy_publics();
}
