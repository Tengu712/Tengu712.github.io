function append_span(cls, text, codeblock) {
    const span = document.createElement("span");
    span.classList.add(cls);
    span.innerText = text;
    codeblock.appendChild(span);
}

function match(code, codeblock, patterns) {
    for (const pattern of patterns) {
        const res = code.match(pattern[0]);
        if (res === null) {
            continue;
        }
        const start = res.indices[0][0];
        const end = res.indices[0][1];
        if (end === 0) {
            append_span("error", "FORMATTING ERROR: ENDLESS LOOP", codeblock);
            return Number.MAX_SAFE_INTEGER;
        }
        let prev_end = 0;
        while (prev_end < start) {
            prev_end += match(code.slice(prev_end, start), codeblock, patterns);
        }
        let matched = code.slice(start, end);
        if (pattern[2] !== null) {
            matched = pattern[2](matched, codeblock);
        }
        const splitted = matched.split('\n');
        for (let i = 0; i < splitted.length; ++i) {
            if (splitted[i].length !== 0)
                append_span(pattern[1], splitted[i], codeblock);
            if (i < splitted.length - 1)
                codeblock.appendChild(document.createElement("br"));
        }
        return end;
    }
    append_span("error", "FORMATTING ERROR: NO MATCH", codeblock);
    return Number.MAX_SAFE_INTEGER;
}

function get_prev_token(c) {
    if (c !== null && (c.classList.contains("space") || c.tagName === "br"))
        return get_prev_token(c.previousElementSibling);
    else
        return c;
}

const make_id_function = (code, codeblock) => {
    const elem = get_prev_token(codeblock.lastChild);
    if (elem.classList.contains("id"))
        elem.classList.add("function");
    return code;
}

const make_id_type = (code, codeblock) => {
    const elem = get_prev_token(codeblock.lastChild);
    if (elem.classList.contains("id"))
        elem.classList.add("type");
    if (code[0] !== '*')
        return code;
    const span = document.createElement("span");
    span.classList.add("type");
    span.innerText = "*";
    codeblock.appendChild(span);
    return code.slice(1);
}

const make_pointer_type = (code, codeblock) => {
}

function patterns_latex() {
    return [
        [/%[^\n]*\n/sd, "comment", null],
        [/{|}|\[|\]|=|,/sd, "plain", null],
        [/[+-]?\d+(\.\d+)?(pt|in|cm|mm)/sd, "literal", null],
        [/\\[a-z]+/sd, "type", null],
        [/.+/sd, "plain", null],
    ];
}

function patterns_c() {
    return [
        [/"([^\n\\]|\\[^\n])*"/sd, "string", null],
        [/\/\/[^\n]*\n/sd, "comment", null],
        [/\/\*([^\*]|\*[^\\])*\*\//sd, "comment", null],
        [/#[^\n]*\n/sd, "comment", null],
        [/[\s\n]+/sd, "space", null],
        [/\(/sd, "plain", make_id_function],
        [/\)|{|}|\[|\]|,|:|;/sd, "plain", null],
        [/^(if|for|while|switch|case|return|continue|break|sizeof)/sd, "keyword", null],
	[/\*?[a-zA-Z_][a-zA-Z0-9_]*\*?/sd, "id", make_id_type],
        [/[+-]?\d+(\.\d+)?(f|)/sd, "literal", null],
        [/\+|-|\*|\/|=|>|<|!/sd, "operator", null],
	[/\./sd, "plain", null],
        [/.+/sd, "plain", null],
    ];
}

window.onload = function () {
    const codeblocks = document.getElementsByClassName("codeblock");
    for (const codeblock of codeblocks) {
        let patterns = null;
        switch (codeblock.classList[1]) {
            case "latex":
                patterns = patterns_latex();
                break;
            case "c":
                patterns = patterns_c();
                break;
        }
        if (patterns === null)
            continue;
        let code = codeblock.innerText;
        codeblock.innerText = "";
        while (code.length > 0) {
            const next = match(code, codeblock, patterns);
            code = code.slice(next);
        }
    }
}
