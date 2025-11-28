use std::fs;

struct Page {
    body: String,
}

impl Page {
    fn from(path: &str) -> Self {
        Self {
            body: fs::read_to_string(path).unwrap(),
        }
    }
}

fn main() {
    println!("{}", markdown::to_html(&Page::from("pages/index.md").body));
}
