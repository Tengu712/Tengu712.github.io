const newline = (_, codeblock) => {
    codeblock.appendChild(document.createElement("br"));
    return true;
}

function append_span(cls, text, codeblock) {
    const span = document.createElement("span");
    span.classList.add(cls);
    span.innerText = text;
    codeblock.appendChild(span);
}

function match(code, codeblock, patterns) {
    let i = 0;
    for (const pattern of patterns) {
        const res = code.match(pattern[0]);
        if (res === null) {
            ++i;
            continue;
        }
        const start = res.indices[0][0];
        const end = res.indices[0][1];
        console.log(i, end, code);
        if (end === 0) {
            append_span("error", "FORMATTING ERROR: ENDLESS LOOP", codeblock);
            return Number.MAX_SAFE_INTEGER;
        }
        let prev_end = 0;
        while (prev_end < start) {
            prev_end += match(code.slice(prev_end, start), codeblock, patterns);
        }
        if (pattern[2] !== null && pattern[2](code, codeblock)) {
            return end;
        }
        append_span(pattern[1], code.slice(start, end), codeblock);
        return end;
    }
    append_span("error", "FORMATTING ERROR: NO MATCH", codeblock);
    return Number.MAX_SAFE_INTEGER;
}

function patterns_latex() {
    return [
        [/\n/sd, "", newline],
        [/^%.*/sd, "comment", null],
        [/^[+-]?\d+(\.\d+)?(pt|in|cm|mm)/sd, "literal", null],
        [/\\[a-z]+/sd, "type", null],
        [/{|}|\[|\]|=|,/sd, "plain", null],
        [/.+/sd, "plain", null],
    ];
}

function patterns_c() {
    return [
        [/\n/sd, "", newline],
        [/^\/\/.*/sd, "comment", null],
        [/^#.*/sd, "comment", null],
        [/^"[^(\\")]*"/sd, "string", null],
        [/^[+-]?\d+(\.\d+)?(f|)/sd, "literal", null],
        [/^(if|for|while|return|continue|break)/sd, "keyword", null],
        [/^(void|const|static|extern|signed|unsigned|char|short|int|long|float|double)/sd, "type", null],
        [/\(|\)|{|}|\[|\]|\+|-|\*|\/|=|>|<|!|.|,|:|;/sd, "plain", null],
        [/\s+/sd, "plain", null],
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
        let code = codeblock.innerText;
        codeblock.innerText = "";
        while (code.length > 0) {
            const next = match(code, codeblock, patterns);
            code = code.slice(next);
        }
    }
}