function createTable(str) {
    const div = document.createElement("div");
    const table = document.createElement("table");
    const thead = document.createElement("thead");
    const tbody = document.createElement("tbody");
    const splited = str.split("$$");
    splited.pop();
    for(let i = 0; i < splited.length; ++i) {
        const tr = document.createElement("tr");
        if (i == 0) {
            splited[i].split('|').forEach(n => {
                const th = document.createElement("th");
                th.innerHTML = n;
                tr.appendChild(th);
            });
            thead.appendChild(tr);
        } else {
            splited[i].split('|').forEach(n => {
                const td = document.createElement("td");
                td.innerHTML = n;
                tr.appendChild(td);
            });
            tbody.appendChild(tr);
        }
    }
    table.appendChild(thead);
    table.appendChild(tbody);
    div.appendChild(table);
    document.body.appendChild(div);
}

window.onload = () => {
    createTable(th06);
    createTable(th07);
    createTable(th08);
    createTable(th09);
    createTable(th10);
    createTable(th11);
    createTable(th12);
    createTable(th13);
    createTable(th14);
    createTable(th15);
    createTable(th16);
    createTable(th17);
    createTable(th18);
}