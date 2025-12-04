use super::*;
use markdown::mdast::{AlignKind, Table};

enum KindOfCell<'a> {
    Th,
    Td(&'a AlignKind),
}

fn cell(cell: &Node, kind: KindOfCell, buf: &mut String, styles: &mut Styles) {
    let Node::TableCell(cell) = cell else {
        panic!("cellじゃねえじゃん");
    };

    let (tag, align) = match kind {
        KindOfCell::Th => ("th", "center"),
        KindOfCell::Td(AlignKind::Left) => ("td", "left"),
        KindOfCell::Td(AlignKind::Right) => ("td", "right"),
        KindOfCell::Td(_) => ("td", "center"),
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

enum KindOfRow<'a> {
    Th,
    Td(&'a [AlignKind]),
}

fn render_row(row: &Node, kind: KindOfRow, buf: &mut String, styles: &mut Styles) {
    let Node::TableRow(row) = row else {
        panic!("rowじゃねえじゃん");
    };

    buf.push_str("<tr>");
    for (i, c) in row.children.iter().enumerate() {
        match kind {
            KindOfRow::Th => cell(c, KindOfCell::Th, buf, styles),
            KindOfRow::Td(aligns) => cell(c, KindOfCell::Td(&aligns[i]), buf, styles),
        }
    }
    buf.push_str("</tr>");
}

pub fn to_html(node: &Table, buf: &mut String, styles: &mut Styles) {
    let Some(head) = node.children.first() else {
        panic!("theadがねえぞ");
    };
    buf.push_str("<div class=\"table-container\"><table><thead>");
    render_row(head, KindOfRow::Th, buf, styles);
    buf.push_str("</thead><tbody>");
    for row in node.children.iter().skip(1) {
        render_row(row, KindOfRow::Td(&node.align), buf, styles);
    }
    buf.push_str("</tbody></table></div>");
}
