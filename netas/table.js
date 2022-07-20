const searchinput = document.getElementById("searchinput");
const counter = document.getElementById("counter");

let splited = [];
let table = null;

function createTable(str) {
    if (table != null) {
        table.remove();
    }
    let cnt = 0;
    table = document.createElement("table");
    const thead = document.createElement("thead");
    const tbody = document.createElement("tbody");
    const trh = document.createElement("tr");
    const th1 = document.createElement("th");
    const th2 = document.createElement("th");
    th1.innerHTML = "ネタ";
    th2.innerHTML = "タグ";
    trh.appendChild(th1);
    trh.appendChild(th2);
    thead.appendChild(trh);
    splited.forEach(n => {
        if (str != "" && n[0].indexOf(str) == -1 && n[1].indexOf(str) == -1)
            return;
        ++cnt;
        const tr = document.createElement("tr");
        const td1 = document.createElement("td");
        const td2 = document.createElement("td");
        td1.innerHTML = n[0];
        td2.innerHTML = n[1];
        tr.appendChild(td1);
        tr.appendChild(td2);
        tbody.appendChild(tr);
    });
    table.appendChild(thead);
    table.appendChild(tbody);
    document.body.appendChild(table);
    counter.innerText = cnt + "/" + splited.length + "件　";
}

function search(event) {
    if (event.keyCode !== 13) {
        return;
    }
    createTable(searchinput.value);
}

window.onload = () => {
    const lines = data.split("$$");
    for (let i = 0; i < lines.length; ++i) {
        splited.push(lines[i].split('|'));
    }
    splited.pop();
    createTable("", -1);
    searchinput.addEventListener("keypress", search);
}