use super::*;
use markdown::mdast::{AlignKind, Table};

fn cell(cell: &Node, tag: &str, align: &AlignKind, buf: &mut String, styles: &mut Styles) {
    let Node::TableCell(cell) = cell else {
        panic!("cellじゃねえじゃん");
    };

    let align = match align {
        AlignKind::Left => "left",
        AlignKind::Right => "right",
        AlignKind::Center | AlignKind::None => "center",
    };

    buf.push('<');
    buf.push_str(tag);
    buf.push_str(" style=\"text-align: ");
    buf.push_str(align);
    buf.push_str("\">");
    mdasts_to_html(&cell.children, buf, styles);
    buf.push_str("</");
    buf.push_str(tag);
    buf.push('>');
}

fn render_row(row: &Node, tag: &str, aligns: &[AlignKind], buf: &mut String, styles: &mut Styles) {
    let Node::TableRow(row) = row else {
        panic!("rowじゃねえじゃん");
    };

    buf.push_str("<tr>");
    for (i, c) in row.children.iter().enumerate() {
        cell(c, tag, &aligns[i], buf, styles);
    }
    buf.push_str("</tr>");
}

pub fn to_html(node: &Table, buf: &mut String, styles: &mut Styles) {
    let Some(head) = node.children.first() else {
        panic!("theadがねえぞ");
    };
    buf.push_str("<table><thead>");
    render_row(head, "th", &node.align, buf, styles);
    buf.push_str("</thead><tbody>");
    for row in node.children.iter().skip(1) {
        render_row(row, "td", &node.align, buf, styles);
    }
    buf.push_str("</tbody></table>");
}
