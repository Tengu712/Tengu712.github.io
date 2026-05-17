use super::*;

pub fn detect_alert_type(children: &[Node]) -> Option<&'static str> {
    let Node::Paragraph(p) = children.first()? else {
        return None;
    };
    let Node::Text(t) = p.children.first()? else {
        return None;
    };
    let prefix = t.value.split('\n').next()?.trim();
    let upper = prefix.to_ascii_uppercase();
    match upper.as_str() {
        "[!NOTE]" => Some("note"),
        "[!TIP]" => Some("tip"),
        "[!IMPORTANT]" => Some("important"),
        "[!WARNING]" => Some("warning"),
        "[!CAUTION]" => Some("caution"),
        _ => None,
    }
}

pub fn to_html(children: &[Node], buf: &mut String, styles: &mut Styles) {
    let Some(Node::Paragraph(first_para)) = children.first() else {
        return;
    };
    let Some(Node::Text(first_text)) = first_para.children.first() else {
        return;
    };

    let rest_text = match first_text.value.find('\n') {
        Some(pos) => &first_text.value[pos + 1..],
        None => "",
    };
    let rest_children = &first_para.children[1..];

    if !rest_text.is_empty() || !rest_children.is_empty() {
        buf.push_str("<p>");
        buf.push_str(rest_text);
        mdasts_to_html(rest_children, buf, styles);
        buf.push_str("</p>");
    }

    mdasts_to_html(&children[1..], buf, styles);
}
