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

fn copy_file(src_path: &PathBuf, dst_path: &Path) {
    ensure_dir(dst_path);
    fs::copy(src_path, dst_path).unwrap();
}

fn write_file(content: &str, dst_path: &Path) {
    ensure_dir(dst_path);
    fs::write(dst_path, content).unwrap();
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
            md::run(&file_path);
        } else {
            copy_file(&file_path, &replace_root_with_dist(&file_path));
        }
    }
}
