//! 文字列に関するモジュール

use std::{
    hash::{Hash, Hasher},
    ptr,
};

pub enum StrOrString {
    Str(&'static str),
    String(String),
}

#[derive(Eq)]
pub struct StrPtr(pub &'static str);

impl PartialEq for StrPtr {
    fn eq(&self, other: &Self) -> bool {
        ptr::eq(self.0.as_ptr(), other.0.as_ptr())
    }
}

impl Hash for StrPtr {
    fn hash<H: Hasher>(&self, state: &mut H) {
        self.0.as_ptr().hash(state);
    }
}
