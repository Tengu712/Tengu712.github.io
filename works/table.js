const all = document.getElementById("all");
const enableimg = document.getElementById("enableimg");
const searchinput = document.getElementById("searchinput");
const searchselect = document.getElementById("searchselect");
const counter = document.getElementById("counter");

let splited = [];
let tables = [];

function show(str) {
    const obj = open();
    obj.document.write("\
        <html>\
        <head>\
            <meta charset='utf-8'>\
            <style>\
                body { background-color: black; margin: 0; }\
                div { width: 100%; height: 100%; }\
                img.image { margin: 0 auto; width: 100%; height: 100%; object-fit: contain; }\
                img.comic {\
                    margin-top: 0;\
                    margin-bottom: 1em;\
                    margin-left: auto;\
                    margin-right: auto;\
                    width: 100%;\
                    height: 100%;\
                    object-fit: contain;\
                }\
            </style>\
        </head>\
        <body>\
            " + str + "\
        </body>\
        </html>\
    ");
}

function createTable(str, mode) {
    if (tables != []) {
        tables.forEach(n => n.remove());
    }
    tables = [];
    let cnt = 0;
    splited.forEach(n => {
        switch (mode) {
            case 0:
                if (n[1].indexOf(str) == -1)
                    return;
                break;
            case 1:
                if (n[3].indexOf(str) == -1)
                    return;
                break;
            case 2:
                if (n[4].indexOf(str) == -1)
                    return;
                break;
        }
        ++cnt;
        const table = document.createElement("table");
        const thead = document.createElement("thead");
        const tbody = document.createElement("tbody");
        const tr1 = document.createElement("tr");
        const tr2 = document.createElement("tr");
        const tr3 = document.createElement("tr");
        const th1 = document.createElement("th");
        const td2 = document.createElement("td");
        const td3 = document.createElement("td");
        const title = document.createElement("p");
        const tag = document.createElement("p");
        let thumb = null;
        if (n[0] == "image") {
            th1.classList.add("image");
            const path = "../img/" + n[2];
            if (enableimg.checked) {
                thumb = document.createElement("img");
                thumb.src = path;
            } else {
                thumb = document.createElement("p");
                thumb.innerHTML = "To show image, check box.";
            }
            thumb.addEventListener(
                "click",
                (event) => {
                    show("<div ><img class='image' src='" + path + "'></img></div>");
                }
            );
        } else if (n[0] == "comic") {
            th1.classList.add("comic");
            const words = n[2].split(',');
            let s = "";
            words.forEach(n => s += "<img class='comic' src='../img/" + n + "'></img>");
            if (enableimg.checked) {
                thumb = document.createElement("img");
                thumb.src = "../img/" + words[0];
            } else {
                thumb = document.createElement("p");
                thumb.innerHTML = "To show image, check box.";
            }
            thumb.addEventListener(
                "click",
                (event) => {
                    show("<div class='image'>" + s + "</div>");
                }
            );
        } else if (n[0] == "novel") {
            th1.classList.add("novel");
            const words = n[2].split(',');
            thumb = document.createElement("a");
            thumb.href = "../novel/" + words[0];
            thumb.innerHTML = words[1];
        }
        title.innerHTML = n[1];
        tag.innerHTML = n[3] + "<br>" + n[4];
        td2.classList.add("thumb");
        td3.classList.add("tag");
        th1.appendChild(title);
        td2.appendChild(thumb);
        td3.appendChild(tag);
        tr1.appendChild(th1);
        tr2.appendChild(td2);
        tr3.appendChild(td3);
        thead.appendChild(tr1);
        tbody.appendChild(tr2);
        tbody.appendChild(tr3);
        table.appendChild(thead);
        table.appendChild(tbody);
        all.appendChild(table);
        tables.push(table);
    });
    counter.innerText = cnt + "/" + splited.length + "??????";
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
    enableimg.checked = false;
    createTable("", -1);
    searchinput.addEventListener("keypress", search);
}