<!DOCTYPE html>

<?php

function trim_filename($path)
{
  $arr = explode("/", $path);
  $end = end($arr);
  return $end;
}

function insert_slash($date)
{
  $res = substr($date, 0, 4);
  $res .= '/';
  $res .= substr($date, 4, 2);
  $res .= '/';
  $res .= substr($date, 6);
  return $res;
}

function without_release($prof)
{
  if (strpos($prof, "NMNB", false) !== false) {
    return "nmnbnr";
  } else if (strpos($prof, "NM") !== false) {
    return "nm";
  } else if (strpos($prof, "NB", false) !== false) {
    return "nbnr";
  } else {
    return "c";
  }
}

function with_release($prof)
{
  if (strpos($prof, "NMNBNR", false) !== false) {
    return "nmnbnr";
  } else if (strpos($prof, "NMNB") !== false) {
    return "nmnb";
  } else if (strpos($prof, "NM") !== false) {
    return "nm";
  } else if (strpos($prof, "NBNR", false) !== false) {
    return "nbnr";
  } else if (strpos($prof, "NB", false) !== false) {
    return "nb";
  } else {
    return "c";
  }
}

function td($title, $header, $name, $fullname, $with_release)
{
  $file = glob($_SERVER['DOCUMENT_ROOT'] . "/data/threplay/" . $header . "*.rpy");
  if (empty($file)) {
    echo "<td>", $name, "</td>";
    return;
  }
  $filename = trim_filename($file[0]);
  $splitted = explode("_", $filename);
  $diff = $splitted[1];
  $prof = $splitted[3];
  $date = $splitted[4];
  $date = substr($date, 0, 8);
  $date = insert_slash($date);
  $class = $with_release ? with_release($prof) : without_release($prof);
  echo
    '<td class="', $class, '">',
    '<a href="javascript:open_popup(\'', $title, "', '", $diff, "', '", $fullname, "', '", $prof, "', '", $date, "', '", $filename, "');\">", $name, "</a>",
    '</td>';
}

?>

<html lang="ja">
<meta charset="utf-8">
<title>東方整数作品クリア機体シート</title>
<style>
  body {
    background-color: black;
    color: white;
  }

  a,
  a:visited {
    color: red;
  }

  table {
    margin-bottom: 24px;
  }

  table,
  th,
  td {
    border: 1px white solid;
  }

  td.nmnbnr {
    background-color: #e2041b; // red
  }

  td.nmnb {
    background-color: #ea5506; // orange
  }

  td.nm {
    background-color: #824880; // purple
  }

  td.nbnr {
    background-color: #1e50a2; // blue
  }

  td.nb {
    background-color: #007b43; // green
  }

  td.c {
    background-color: #595455; // gray
  }

  td>a,
  td>a:visited {
    color: inherit;
    text-decoration: none;
  }

  table.ftable {
    border: none;
    border-collapse: collapse;
    margin: 0;
    padding: 0;
    width: 800px;
    height: 350px;
  }

  table.th6 {
    width: 100%;
    height: 100%;
    font-size: 1.0em;
  }

  table.th7 {
    width: 100%;
    height: 100%;
    font-size: 0.7em;
  }

  table.th8 {
    width: 100%;
    height: 100%;
    font-size: 0.7em;
  }

  table.th9 {
    width: 100%;
    height: 100%;
    font-size: 0.7em;
  }

  table.th10 {
    width: 100%;
    height: 100%;
    font-size: 1.0em;
  }

  table.th11 {
    width: 100%;
    height: 100%;
    font-size: 1.0em;
  }

  table.th12 {
    width: 100%;
    height: 100%;
    font-size: 1.0em;
  }

  table.color {
    width: 100%;
    height: 100%;
    font-size: 1.0em;
  }

  table.ftable td {
    padding: 0;
  }

  p#typeoption {
    text-align: right;
  }

  div#popup {
    background-color: rgba(0, 0, 0, 0.9);
    color: white;
    padding: 16px;
    position: absolute;
    min-width: 400px;
    min-height: 250px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
  }

  div#popup>p.link {
    text-align: center;
  }
</style>

<div style="text-align: center;">
  <p>SKD(天狗)の東方整数作品のクリア機体表兼リプレイ置き場です。<br>同階級の実績のうち、最も古いリプレイを安置しています。</p>
  <p>NBについて、3M以内であれば特筆してあります。<br>スコアタは紅EX魔Bしかやっていないので無し。</p>
  <hr>
</div>

<br>

<center>
  <table class="ftable">
    <tr>
      <th>紅魔郷</th>
      <th>妖々夢</th>
      <th>永夜抄</th>
      <th>花映塚</th>
      <th>風神録</th>
      <th>地霊殿</th>
      <th>星蓮船</th>
    </tr>
    <tr>
      <td>
        <!-- =============================================== 東方紅魔郷 ================================================ -->
        <table class="ftable th6">
          <tr>
            <td rowspan="2">E</td>
            <?php td("東方紅魔郷", "th6_Easy_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方紅魔郷", "th6_Easy_ReimuB", "霊B", "霊夢B", false); ?>
          </tr>
          <tr>
            <?php td("東方紅魔郷", "th6_Easy_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方紅魔郷", "th6_Easy_MarisaB", "魔B", "魔理沙B", false); ?>
          </tr>
          <tr>
            <td rowspan="2">N</td>
            <?php td("東方紅魔郷", "th6_Normal_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方紅魔郷", "th6_Normal_ReimuB", "霊B", "霊夢B", false); ?>
          </tr>
          <tr>
            <?php td("東方紅魔郷", "th6_Normal_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方紅魔郷", "th6_Normal_MarisaB", "魔B", "魔理沙B", false); ?>
          </tr>
          <tr>
            <td rowspan="2">H</td>
            <?php td("東方紅魔郷", "th6_Hard_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方紅魔郷", "th6_Hard_ReimuB", "霊B", "霊夢B", false); ?>
          </tr>
          <tr>
            <?php td("東方紅魔郷", "th6_Hard_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方紅魔郷", "th6_Hard_MarisaB", "魔B", "魔理沙B", false); ?>
          </tr>
          <tr>
            <td rowspan="2">L</td>
            <?php td("東方紅魔郷", "th6_Lunatic_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方紅魔郷", "th6_Lunatic_ReimuB", "霊B", "霊夢B", false); ?>
          </tr>
          <tr>
            <?php td("東方紅魔郷", "th6_Lunatic_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方紅魔郷", "th6_Lunatic_MarisaB", "魔B", "魔理沙B", false); ?>
          </tr>
          <tr>
            <td rowspan="2">X</td>
            <?php td("東方紅魔郷", "th6_Extra_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方紅魔郷", "th6_Extra_ReimuB", "霊B", "霊夢B", false); ?>
          </tr>
          <tr>
            <?php td("東方紅魔郷", "th6_Extra_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方紅魔郷", "th6_Extra_MarisaB", "魔B", "魔理沙B", false); ?>
          </tr>
        </table>
      </td>
      <td>
        <!-- =============================================== 東方妖々夢 ================================================ -->
        <table class="ftable th7">
          <tr>
            <td rowspan="2">E</td>
            <?php td("東方妖々夢", "th7_Easy_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方妖々夢", "th7_Easy_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方妖々夢", "th7_Easy_SakuyaA", "咲A", "咲夜A", true); ?>
          </tr>
          <tr>
            <?php td("東方妖々夢", "th7_Easy_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方妖々夢", "th7_Easy_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方妖々夢", "th7_Easy_SakuyaB", "咲B", "咲夜B", true); ?>
          </tr>
          <tr>
            <td rowspan="2">N</td>
            <?php td("東方妖々夢", "th7_Normal_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方妖々夢", "th7_Normal_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方妖々夢", "th7_Normal_SakuyaA", "咲A", "咲夜A", true); ?>
          </tr>
          <tr>
            <?php td("東方妖々夢", "th7_Normal_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方妖々夢", "th7_Normal_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方妖々夢", "th7_Normal_SakuyaB", "咲B", "咲夜B", true); ?>
          </tr>
          <tr>
            <td rowspan="2">H</td>
            <?php td("東方妖々夢", "th7_Hard_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方妖々夢", "th7_Hard_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方妖々夢", "th7_Hard_SakuyaA", "咲A", "咲夜A", true); ?>
          </tr>
          <tr>
            <?php td("東方妖々夢", "th7_Hard_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方妖々夢", "th7_Hard_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方妖々夢", "th7_Hard_SakuyaB", "咲B", "咲夜B", true); ?>
          </tr>
          <tr>
            <td rowspan="2">L</td>
            <?php td("東方妖々夢", "th7_Lunatic_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方妖々夢", "th7_Lunatic_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方妖々夢", "th7_Lunatic_SakuyaA", "咲A", "咲夜A", true); ?>
          </tr>
          <tr>
            <?php td("東方妖々夢", "th7_Lunatic_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方妖々夢", "th7_Lunatic_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方妖々夢", "th7_Lunatic_SakuyaB", "咲B", "咲夜B", true); ?>
          </tr>
          <tr>
            <td rowspan="2">X</td>
            <?php td("東方妖々夢", "th7_Extra_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方妖々夢", "th7_Extra_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方妖々夢", "th7_Extra_SakuyaA", "咲A", "咲夜A", true); ?>
          </tr>
          <tr>
            <?php td("東方妖々夢", "th7_Extra_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方妖々夢", "th7_Extra_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方妖々夢", "th7_Extra_SakuyaB", "咲B", "咲夜B", true); ?>
          </tr>
          <tr>
            <td rowspan="2">P</td>
            <?php td("東方妖々夢", "th7_Phantasm_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方妖々夢", "th7_Phantasm_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方妖々夢", "th7_Phantasm_SakuyaA", "咲A", "咲夜A", true); ?>
          </tr>
          <tr>
            <?php td("東方妖々夢", "th7_Phantasm_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方妖々夢", "th7_Phantasm_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方妖々夢", "th7_Phantasm_SakuyaB", "咲B", "咲夜B", true); ?>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <th>神霊廟</th>
      <th>輝針城</th>
      <th>紺珠伝</th>
      <th>天空璋</th>
      <th>鬼形獣</th>
      <th>虹龍洞</th>
      <th></th>
    </tr>
  </table>
</center>

<script>
  let div = null;
  function open_popup(title, diff, chara, status, date, link) {
    if (div !== null) {
      document.body.removeChild(div);
    }
    div = document.createElement("div");
    div.id = "popup";
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
    a_link.href = "https://skdassoc.com/data/threplay/" + link;
    a_link.innerText = "リプレイをダウンロード";
    p_link.appendChild(a_link);
    div.appendChild(p_title);
    div.appendChild(p_diff);
    div.appendChild(p_chara);
    div.appendChild(p_status);
    div.appendChild(p_date);
    div.appendChild(p_link);
    document.body.appendChild(div);
    div.onclick = (e) => e.stopPropagation();
  }
  document.onclick = () => {
    if (div !== null) {
      document.body.removeChild(div);
      div = null;
    }
  };
</script>