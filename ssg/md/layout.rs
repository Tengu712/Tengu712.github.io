//! レイアウトを定義するモジュール

use crate::{embedded::*, md::convert, strutil::StrPtr, template::Styles};
use markdown::mdast::Node;
use serde::Deserialize;
use serde_yaml::Value;

pub mod article;
pub mod basic;
pub mod scrap;
