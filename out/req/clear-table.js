// 
let popup = null

// 
document.addEventListener("click", () => {
  if (popup !== null) {
    document.body.removeChild(popup);
    popup = null;
  }
})

// 
function openPopup(title, diff, chara, status, date, link) {
  if (popup !== null) {
    document.body.removeChild(popup);
  }
  popup = document.createElement("div");
  popup.classList.add("popup");
  const p_title = document.createElement("p");
  p_title.innerText = "作品　：" + title;
  const p_diff = document.createElement("p");
  p_diff.innerText = "難易度：" + diff;
  const p_chara = document.createElement("p");
  p_chara.innerText = "機体　：" + chara;
  const p_status = document.createElement("p");
  p_status.innerText = "実績　：" + status;
  const p_date = document.createElement("p");
  p_date.innerText = "達成日：" + date;
  const p_link = document.createElement("p");
  p_link.classList.add("link");
  const a_link = document.createElement("A", false);
  a_link.href = "https://rpys.skdassoc.work/" + link;
  a_link.innerText = "リプレイをダウンロード";
  p_link.appendChild(a_link);
  popup.appendChild(p_title);
  popup.appendChild(p_diff);
  popup.appendChild(p_chara);
  popup.appendChild(p_status);
  popup.appendChild(p_date);
  popup.appendChild(p_link);
  document.body.appendChild(popup);
  popup.onclick = (e) => e.stopPropagation();
}

document.addEventListener("DOMContentLoaded", async () => {
  // 
  function getClassName(achivement, releasable) {
    if (releasable) {
      if (achivement.includes('NMNBNR')) return "nmnbnr"
      if (achivement.includes('NMNBNV')) return "nmnbnr"
      if (achivement.includes('NMNBNT')) return "nmnbnr"
      if (achivement.includes('NMNBNC')) return "nmnbnr"
      if (achivement.includes('NMNB')) return "nmnb"
      if (achivement.includes('NMNR')) return "nmnr"
      if (achivement.includes('NMNV')) return "nmnr"
      if (achivement.includes('NMNT')) return "nmnr"
      if (achivement.includes('NMNC')) return "nmnr"
      if (achivement.includes('NM')) return "nm"
      if (achivement.includes('NBNR')) return "nbnr"
      if (achivement.includes('NBNV')) return "nbnr"
      if (achivement.includes('NBNT')) return "nbnr"
      if (achivement.includes('NBNC')) return "nbnr"
      if (achivement.includes('NB')) return "nb"
      return "c"
    }
    else {
      if (achivement.includes('NMNB')) return "nmnbnr"
      if (achivement.includes('NM')) return "nmnr"
      if (achivement.includes('NB')) return "nbnr"
      return "c"
    }
  }

  //
  function getTitle(th) {
    switch (th) {
      case "th6": return "東方紅魔郷"
      case "th7": return "妖々夢"
      case "th8": return "永夜抄"
      case "th9": return "花映塚"
      case "th10": return "風神録"
      case "th11": return "地霊殿"
      case "th12": return "星蓮船"
      case "th13": return "新霊廟"
      case "th14": return "輝針城"
      case "th15": return "紺珠伝"
      case "th16": return "天空璋"
      case "th17": return "鬼形獣"
      case "th18": return "虹龍洞"
    }
  }

  //
  function getChara(eng) {
    switch (eng) {
      case "Reimu": return "霊夢"
      case "ReimuA": return "霊夢A"
      case "ReimuB": return "霊夢B"
      case "ReimuC": return "霊夢C"
      case "ReimuSpring": return "霊夢(春)"
      case "ReimuSummer": return "霊夢(夏)"
      case "ReimuAutumn": return "霊夢(秋)"
      case "ReimuWinter": return "霊夢(冬)"

      // marisa
      case "Marisa": return "魔理沙"
      case "MarisaA": return "魔理沙A"
      case "MarisaB": return "魔理沙B"
      case "MarisaC": return "魔理沙C"
      case "MarisaSpring": return "魔理沙(春)"
      case "MarisaSummer": return "魔理沙(夏)"
      case "MarisaAutumn": return "魔理沙(秋)"
      case "MarisaWinter": return "魔理沙(冬)"

      // sakuya
      case "Sakuya": return "咲夜"
      case "SakuyaA": return "咲夜A"
      case "SakuyaB": return "咲夜B"

      // sanae
      case "Sanae": return "早苗"
      case "SanaeA": return "早苗A"
      case "SanaeB": return "早苗B"

      // youmu
      case "Youmu": return "妖夢"
      case "YoumuA": return "妖夢A"
      case "YoumuB": return "妖夢B"
      case "YoumuC": return "妖夢C"

      // cirno
      case "Cirno": return "チルノ"
      case "CirnoSpring": return "チルノ(春)"
      case "CirnoSummer": return "チルノ(夏)"
      case "CirnoAutumn": return "チルノ(秋)"
      case "CirnoWinter": return "チルノ(冬)"

      // Aya
      case "Aya": return "文"
      case "AyaSpring": return "文(春)"
      case "AyaSummer": return "文(夏)"
      case "AyaAutumn": return "文(秋)"
      case "AyaWinter": return "文(冬)"

      // other
      case "Reisen": return "鈴仙"
      case "Lyrica": return "リリカ"
      case "Mystia": return "ミスティア"
      case "Tei": return "てゐ"
      case "Medicine": return "メディスン"
      case "Yuuka": return "幽香"
      case "Komachi": return "小町"
      case "Eiki": return "映姫"

      // group
      case "Kekkai": return "結界組"
      case "AKekkai": return "√A 結界組"
      case "AKekkai": return "√B 結界組"
      case "Eishou": return "詠唱組"
      case "AEishou": return "√A 詠唱組"
      case "BEishou": return "√B 詠唱組"
      case "Kouma": return "紅魔組"
      case "AKouma": return "√A 紅魔組"
      case "BKouma": return "√B 紅魔組"
      case "Yuumei": return "幽冥組"
      case "AYuumei": return "√A 幽冥組"
      case "BYuumei": return "√B 幽冥組"
      // human
      case "AReimu": return "√A 霊夢"
      case "BReimu": return "√B 霊夢"
      case "AMarisa": return "√A 魔理沙"
      case "BMarisa": return "√B 魔理沙"
      case "ASakuya": return "√A 咲夜"
      case "BSakuya": return "√B 咲夜"
      case "AYoumu": return "√A 妖夢"
      case "BYoumu": return "√B 妖夢"
      // evil
      case "Yukari": return "紫"
      case "AYukari": return "√A 紫"
      case "BYukari": return "√B 紫"
      case "Alice": return "アリス"
      case "AAlice": return "√A アリス"
      case "BAlice": return "√B アリス"
      case "Remilia": return "レミリア"
      case "ARemilia": return "√A レミリア"
      case "BRemilia": return "√B レミリア"
      case "Yuyuko": return "幽々子"
      case "AYuyuko": return "√A 幽々子"
      case "BYuyuko": return "√B 幽々子"
    }
  }

  //
  function getDate(date) {
    var year = date.substring(0, 4);
    var month = date.substring(4, 6);
    var day = date.substring(6, 8);
    return year + "/" + month + "/" + day;
  }

  // 
  const response = await fetch('https://listrpys.genreihoutengu.workers.dev')
  if (!response.ok) {
    console.error('[ error ] failed to get list of replay files.')
    return
  }
  const json = await response.json()
  for (const n of json.list) {
    if (n.startsWith("_")) {
      continue
    }
    const splitted = n.split("_")
    const name = splitted.slice(0, 3).join("_")
    const nodes = document.getElementsByClassName(name)
    if (!nodes || !nodes[0]) {
      console.warn('[ warning ] invalid name ' + name + ' found.')
      continue
    }
    nodes[0].classList.add(getClassName(splitted[3]))
    const a = document.createElement("a")
    a.href = "javascript:openPopup('" + getTitle(splitted[0]) + "','" + splitted[1] + "','" + getChara(splitted[2]) + "','" + splitted[3] + "','" + getDate(splitted[4].substring(0, 8)) + "','" + n + "');"
    a.innerText = nodes[0].innerText
    nodes[0].innerText = ""
    nodes[0].appendChild(a)
  }
})