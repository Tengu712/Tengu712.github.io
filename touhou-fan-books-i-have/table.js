const searchinput = document.getElementById("searchinput");
const searchselect = document.getElementById("searchselect");
const counter = document.getElementById("counter");

let splited = [];
let table = null;
let thead = null;
let tbody = null;

function common() {
    if (table != null) {
        table.remove();
    }
    table = document.createElement("table");
    thead = document.createElement("thead");
    tbody = document.createElement("tbody");
    table.appendChild(thead);
    table.appendChild(tbody);
}

function header() {
    const tr = document.createElement("tr");
    const th1 = document.createElement("th");
    const th2 = document.createElement("th");
    const th3 = document.createElement("th");
    const th4 = document.createElement("th");
    const th5 = document.createElement("th");
    th1.innerHTML = "サークル名";
    th2.innerHTML = "作者名";
    th3.innerHTML = "タイトル";
    th4.innerHTML = "発行日";
    th5.innerHTML = "概要";
    tr.appendChild(th1);
    tr.appendChild(th2);
    tr.appendChild(th3);
    tr.appendChild(th4);
    tr.appendChild(th5);
    thead.appendChild(tr);
}

function createTable(str, mode) {
    common();
    header();
    let flag = true;
    let cnt = 0;
    splited.forEach(n => {
        switch (mode) {
            case 0:
            case 1:
            case 2:
                if (flag) {
                    if (n[mode] != str)
                        return;
                    else {
                        flag = false;
                        break;
                    }
                } else {
                    if (n[mode] == "")
                        break;
                    else if (n[mode] != str) {
                        flag = true;
                        return;
                    } else
                        break;
                }
            case 3:
            case 4:
                if (flag) {
                    if (n[mode].indexOf(str) == -1)
                        return;
                    else {
                        flag = false;
                        break;
                    }
                } else {
                    if (n[mode] == "")
                        break;
                    else if (n[mode].indexOf(str) == -1) {
                        flag = true;
                        return;
                    } else
                        break;
                }
        }
        ++cnt;
        const tr = document.createElement("tr");
        for (let i = 0; i < 5; ++i) {
            const td = document.createElement("td");
            td.innerHTML = n[i];
            tr.appendChild(td);
        }
        tbody.appendChild(tr);
    });
    counter.innerText = cnt + "/" + splited.length + "件　";
    document.body.appendChild(table);
}

function search(event) {
    if (event.keyCode !== 13) {
        return;
    }
    if (searchinput.value == "")
        createTable("", -1);
    else
        createTable(searchinput.value, searchselect.selectedIndex);
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
