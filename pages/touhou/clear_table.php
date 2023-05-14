<!DOCTYPE html>
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

  table.th6,
  table.th10,
  table.th11,
  table.th12,
  table.th13,
  table.th14,
  table.th15,
  table.th18 {
    width: 100%;
    height: 100%;
    font-size: 1.0em;
  }

  table.th7,
  table.th17 {
    width: 100%;
    height: 100%;
    font-size: 0.7em;
  }

  table.th8,
  table.th9,
  table.th16 {
    width: 100%;
    height: 100%;
    font-size: 0.7em;
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
      <td>
        <!-- =============================================== 東方永夜抄 ================================================ -->
        <table class="ftable th8">
          <tr>
            <td rowspan="3">E</td>
            <?php td("東方永夜抄", "th8_Easy_Kekkai", "結", "結界組", false); ?>
            <?php td("東方永夜抄", "th8_Easy_Eishou", "詠", "詠唱組", false); ?>
            <?php td("東方永夜抄", "th8_Easy_Kouma", "紅", "紅魔組", false); ?>
            <?php td("東方永夜抄", "th8_Easy_Yumei", "冥", "幽冥組", false); ?>
          </tr>
          <tr>
            <?php td("東方永夜抄", "th8_Easy_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方永夜抄", "th8_Easy_Marisa", "魔", "魔理沙", false); ?>
            <?php td("東方永夜抄", "th8_Easy_Sakuya", "咲", "咲夜", false); ?>
            <?php td("東方永夜抄", "th8_Easy_Youmu", "妖", "妖夢", false); ?>
          </tr>
          <tr>
            <?php td("東方永夜抄", "th8_Easy_Yukari", "紫", "紫", false); ?>
            <?php td("東方永夜抄", "th8_Easy_Alice", "ア", "アリス", false); ?>
            <?php td("東方永夜抄", "th8_Easy_Remilia", "レ", "レミリア", false); ?>
            <?php td("東方永夜抄", "th8_Easy_Yuyuko", "幽", "幽々子", false); ?>
          </tr>
          <tr>
            <td rowspan="3">N</td>
            <?php td("東方永夜抄", "th8_Normal_Kekkai", "結", "結界組", false); ?>
            <?php td("東方永夜抄", "th8_Normal_Eishou", "詠", "詠唱組", false); ?>
            <?php td("東方永夜抄", "th8_Normal_Kouma", "紅", "紅魔組", false); ?>
            <?php td("東方永夜抄", "th8_Normal_Yumei", "冥", "幽冥組", false); ?>
          </tr>
          <tr>
            <?php td("東方永夜抄", "th8_Normal_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方永夜抄", "th8_Normal_Marisa", "魔", "魔理沙", false); ?>
            <?php td("東方永夜抄", "th8_Normal_Sakuya", "咲", "咲夜", false); ?>
            <?php td("東方永夜抄", "th8_Normal_Youmu", "妖", "妖夢", false); ?>
          </tr>
          <tr>
            <?php td("東方永夜抄", "th8_Normal_Yukari", "紫", "紫", false); ?>
            <?php td("東方永夜抄", "th8_Normal_Alice", "ア", "アリス", false); ?>
            <?php td("東方永夜抄", "th8_Normal_Remilia", "レ", "レミリア", false); ?>
            <?php td("東方永夜抄", "th8_Normal_Yuyuko", "幽", "幽々子", false); ?>
          </tr>
          <tr>
            <td rowspan="3">H</td>
            <?php td("東方永夜抄", "th8_Hard_Kekkai", "結", "結界組", false); ?>
            <?php td("東方永夜抄", "th8_Hard_Eishou", "詠", "詠唱組", false); ?>
            <?php td("東方永夜抄", "th8_Hard_Kouma", "紅", "紅魔組", false); ?>
            <?php td("東方永夜抄", "th8_Hard_Yumei", "冥", "幽冥組", false); ?>
          </tr>
          <tr>
            <?php td("東方永夜抄", "th8_Hard_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方永夜抄", "th8_Hard_Marisa", "魔", "魔理沙", false); ?>
            <?php td("東方永夜抄", "th8_Hard_Sakuya", "咲", "咲夜", false); ?>
            <?php td("東方永夜抄", "th8_Hard_Youmu", "妖", "妖夢", false); ?>
          </tr>
          <tr>
            <?php td("東方永夜抄", "th8_Hard_Yukari", "紫", "紫", false); ?>
            <?php td("東方永夜抄", "th8_Hard_Alice", "ア", "アリス", false); ?>
            <?php td("東方永夜抄", "th8_Hard_Remilia", "レ", "レミリア", false); ?>
            <?php td("東方永夜抄", "th8_Hard_Yuyuko", "幽", "幽々子", false); ?>
          </tr>
          <tr>
            <td rowspan="3">L</td>
            <?php td("東方永夜抄", "th8_Lunatic_Kekkai", "結", "結界組", false); ?>
            <?php td("東方永夜抄", "th8_Lunatic_Eishou", "詠", "詠唱組", false); ?>
            <?php td("東方永夜抄", "th8_Lunatic_Kouma", "紅", "紅魔組", false); ?>
            <?php td("東方永夜抄", "th8_Lunatic_Yumei", "冥", "幽冥組", false); ?>
          </tr>
          <tr>
            <?php td("東方永夜抄", "th8_Lunatic_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方永夜抄", "th8_Lunatic_Marisa", "魔", "魔理沙", false); ?>
            <?php td("東方永夜抄", "th8_Lunatic_Sakuya", "咲", "咲夜", false); ?>
            <?php td("東方永夜抄", "th8_Lunatic_Youmu", "妖", "妖夢", false); ?>
          </tr>
          <tr>
            <?php td("東方永夜抄", "th8_Lunatic_Yukari", "紫", "紫", false); ?>
            <?php td("東方永夜抄", "th8_Lunatic_Alice", "ア", "アリス", false); ?>
            <?php td("東方永夜抄", "th8_Lunatic_Remilia", "レ", "レミリア", false); ?>
            <?php td("東方永夜抄", "th8_Lunatic_Yuyuko", "幽", "幽々子", false); ?>
          </tr>
          <tr>
            <td rowspan="3">X</td>
            <?php td("東方永夜抄", "th8_Extra_Kekkai", "結", "結界組", false); ?>
            <?php td("東方永夜抄", "th8_Extra_Eishou", "詠", "詠唱組", false); ?>
            <?php td("東方永夜抄", "th8_Extra_Kouma", "紅", "紅魔組", false); ?>
            <?php td("東方永夜抄", "th8_Extra_Yumei", "冥", "幽冥組", false); ?>
          </tr>
          <tr>
            <?php td("東方永夜抄", "th8_Extra_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方永夜抄", "th8_Extra_Marisa", "魔", "魔理沙", false); ?>
            <?php td("東方永夜抄", "th8_Extra_Sakuya", "咲", "咲夜", false); ?>
            <?php td("東方永夜抄", "th8_Extra_Youmu", "妖", "妖夢", false); ?>
          </tr>
          <tr>
            <?php td("東方永夜抄", "th8_Extra_Yukari", "紫", "紫", false); ?>
            <?php td("東方永夜抄", "th8_Extra_Alice", "ア", "アリス", false); ?>
            <?php td("東方永夜抄", "th8_Extra_Remilia", "レ", "レミリア", false); ?>
            <?php td("東方永夜抄", "th8_Extra_Yuyuko", "幽", "幽々子", false); ?>
          </tr>
        </table>
      </td>
      <td>
        <!-- =============================================== 東方花映塚 ================================================ -->
        <table class="ftable th9">
          <tr>
            <td rowspan="3">E</td>
            <?php td("東方花映塚", "th9_Easy_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方花映塚", "th9_Easy_Marisa", "魔", "魔理沙", false); ?>
            <?php td("東方花映塚", "th9_Easy_Sakuya", "咲", "咲夜", false); ?>
            <?php td("東方花映塚", "th9_Easy_Youmu", "妖", "妖夢", false); ?>
            <?php td("東方花映塚", "th9_Easy_Reisen", "鈴", "鈴仙", false); ?>
          </tr>
          <tr>
            <?php td("東方花映塚", "th9_Easy_Cirno", "チ", "チルノ", false); ?>
            <?php td("東方花映塚", "th9_Easy_Lyrica", "リ", "リリカ", false); ?>
            <?php td("東方花映塚", "th9_Easy_Mystia", "ミ", "ミスティア", false); ?>
            <?php td("東方花映塚", "th9_Easy_Tei", "て", "てゐ", false); ?>
            <?php td("東方花映塚", "th9_Easy_Aya", "文", "文", false); ?>
          </tr>
          <tr>
            <?php td("東方花映塚", "th9_Easy_Medicine", "メ", "メディスン", false); ?>
            <?php td("東方花映塚", "th9_Easy_Yuuka", "幽", "幽香", false); ?>
            <?php td("東方花映塚", "th9_Easy_Komachi", "小", "小町", false); ?>
            <?php td("東方花映塚", "th9_Easy_Eiki", "映", "映姫", false); ?>
          </tr>
          <tr>
            <td rowspan="3">N</td>
            <?php td("東方花映塚", "th9_Normal_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方花映塚", "th9_Normal_Marisa", "魔", "魔理沙", false); ?>
            <?php td("東方花映塚", "th9_Normal_Sakuya", "咲", "咲夜", false); ?>
            <?php td("東方花映塚", "th9_Normal_Youmu", "妖", "妖夢", false); ?>
            <?php td("東方花映塚", "th9_Normal_Reisen", "鈴", "鈴仙", false); ?>
          </tr>
          <tr>
            <?php td("東方花映塚", "th9_Normal_Cirno", "チ", "チルノ", false); ?>
            <?php td("東方花映塚", "th9_Normal_Lyrica", "リ", "リリカ", false); ?>
            <?php td("東方花映塚", "th9_Normal_Mystia", "ミ", "ミスティア", false); ?>
            <?php td("東方花映塚", "th9_Normal_Tei", "て", "てゐ", false); ?>
            <?php td("東方花映塚", "th9_Normal_Aya", "文", "文", false); ?>
          </tr>
          <tr>
            <?php td("東方花映塚", "th9_Normal_Medicine", "メ", "メディスン", false); ?>
            <?php td("東方花映塚", "th9_Normal_Yuuka", "幽", "幽香", false); ?>
            <?php td("東方花映塚", "th9_Normal_Komachi", "小", "小町", false); ?>
            <?php td("東方花映塚", "th9_Normal_Eiki", "映", "映姫", false); ?>
          </tr>
          <tr>
            <td rowspan="3">H</td>
            <?php td("東方花映塚", "th9_Hard_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方花映塚", "th9_Hard_Marisa", "魔", "魔理沙", false); ?>
            <?php td("東方花映塚", "th9_Hard_Sakuya", "咲", "咲夜", false); ?>
            <?php td("東方花映塚", "th9_Hard_Youmu", "妖", "妖夢", false); ?>
            <?php td("東方花映塚", "th9_Hard_Reisen", "鈴", "鈴仙", false); ?>
          </tr>
          <tr>
            <?php td("東方花映塚", "th9_Hard_Cirno", "チ", "チルノ", false); ?>
            <?php td("東方花映塚", "th9_Hard_Lyrica", "リ", "リリカ", false); ?>
            <?php td("東方花映塚", "th9_Hard_Mystia", "ミ", "ミスティア", false); ?>
            <?php td("東方花映塚", "th9_Hard_Tei", "て", "てゐ", false); ?>
            <?php td("東方花映塚", "th9_Hard_Aya", "文", "文", false); ?>
          </tr>
          <tr>
            <?php td("東方花映塚", "th9_Hard_Medicine", "メ", "メディスン", false); ?>
            <?php td("東方花映塚", "th9_Hard_Yuuka", "幽", "幽香", false); ?>
            <?php td("東方花映塚", "th9_Hard_Komachi", "小", "小町", false); ?>
            <?php td("東方花映塚", "th9_Hard_Eiki", "映", "映姫", false); ?>
          </tr>
          <tr>
            <td rowspan="3">L</td>
            <?php td("東方花映塚", "th9_Lunatic_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方花映塚", "th9_Lunatic_Marisa", "魔", "魔理沙", false); ?>
            <?php td("東方花映塚", "th9_Lunatic_Sakuya", "咲", "咲夜", false); ?>
            <?php td("東方花映塚", "th9_Lunatic_Youmu", "妖", "妖夢", false); ?>
            <?php td("東方花映塚", "th9_Lunatic_Reisen", "鈴", "鈴仙", false); ?>
          </tr>
          <tr>
            <?php td("東方花映塚", "th9_Lunatic_Cirno", "チ", "チルノ", false); ?>
            <?php td("東方花映塚", "th9_Lunatic_Lyrica", "リ", "リリカ", false); ?>
            <?php td("東方花映塚", "th9_Lunatic_Mystia", "ミ", "ミスティア", false); ?>
            <?php td("東方花映塚", "th9_Lunatic_Tei", "て", "てゐ", false); ?>
            <?php td("東方花映塚", "th9_Lunatic_Aya", "文", "文", false); ?>
          </tr>
          <tr>
            <?php td("東方花映塚", "th9_Lunatic_Medicine", "メ", "メディスン", false); ?>
            <?php td("東方花映塚", "th9_Lunatic_Yuuka", "幽", "幽香", false); ?>
            <?php td("東方花映塚", "th9_Lunatic_Komachi", "小", "小町", false); ?>
            <?php td("東方花映塚", "th9_Lunatic_Eiki", "映", "映姫", false); ?>
          </tr>
          <tr>
            <td rowspan="3">X</td>
            <?php td("東方花映塚", "th9_Extra_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方花映塚", "th9_Extra_Marisa", "魔", "魔理沙", false); ?>
            <?php td("東方花映塚", "th9_Extra_Sakuya", "咲", "咲夜", false); ?>
            <?php td("東方花映塚", "th9_Extra_Youmu", "妖", "妖夢", false); ?>
            <?php td("東方花映塚", "th9_Extra_Reisen", "鈴", "鈴仙", false); ?>
          </tr>
          <tr>
            <?php td("東方花映塚", "th9_Extra_Cirno", "チ", "チルノ", false); ?>
            <?php td("東方花映塚", "th9_Extra_Lyrica", "リ", "リリカ", false); ?>
            <?php td("東方花映塚", "th9_Extra_Mystia", "ミ", "ミスティア", false); ?>
            <?php td("東方花映塚", "th9_Extra_Tei", "て", "てゐ", false); ?>
            <?php td("東方花映塚", "th9_Extra_Aya", "文", "文", false); ?>
          </tr>
          <tr>
            <?php td("東方花映塚", "th9_Extra_Medicine", "メ", "メディスン", false); ?>
            <?php td("東方花映塚", "th9_Extra_Yuuka", "幽", "幽香", false); ?>
            <?php td("東方花映塚", "th9_Extra_Komachi", "小", "小町", false); ?>
            <?php td("東方花映塚", "th9_Extra_Eiki", "映", "映姫", false); ?>
          </tr>
        </table>
      </td>
      <td>
        <!-- =============================================== 東方風神録 ================================================ -->
        <table class="ftable th10">
          <tr>
            <td rowspan="2">E</td>
            <?php td("東方風神録", "th10_Easy_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方風神録", "th10_Easy_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方風神録", "th10_Easy_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方風神録", "th10_Easy_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方風神録", "th10_Easy_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方風神録", "th10_Easy_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
          <tr>
            <td rowspan="2">N</td>
            <?php td("東方風神録", "th10_Normal_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方風神録", "th10_Normal_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方風神録", "th10_Normal_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方風神録", "th10_Normal_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方風神録", "th10_Normal_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方風神録", "th10_Normal_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
          <tr>
            <td rowspan="2">H</td>
            <?php td("東方風神録", "th10_Hard_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方風神録", "th10_Hard_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方風神録", "th10_Hard_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方風神録", "th10_Hard_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方風神録", "th10_Hard_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方風神録", "th10_Hard_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
          <tr>
            <td rowspan="2">L</td>
            <?php td("東方風神録", "th10_Lunatic_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方風神録", "th10_Lunatic_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方風神録", "th10_Lunatic_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方風神録", "th10_Lunatic_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方風神録", "th10_Lunatic_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方風神録", "th10_Lunatic_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
          <tr>
            <td rowspan="2">X</td>
            <?php td("東方風神録", "th10_Extra_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方風神録", "th10_Extra_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方風神録", "th10_Extra_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方風神録", "th10_Extra_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方風神録", "th10_Extra_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方風神録", "th10_Extra_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
        </table>
      </td>
      <td>
        <!-- =============================================== 東方地霊殿 ================================================ -->
        <table class="ftable th10">
          <tr>
            <td rowspan="2">E</td>
            <?php td("東方地霊殿", "th11_Easy_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方地霊殿", "th11_Easy_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方地霊殿", "th11_Easy_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方地霊殿", "th11_Easy_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方地霊殿", "th11_Easy_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方地霊殿", "th11_Easy_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
          <tr>
            <td rowspan="2">N</td>
            <?php td("東方地霊殿", "th11_Normal_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方地霊殿", "th11_Normal_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方地霊殿", "th11_Normal_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方地霊殿", "th11_Normal_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方地霊殿", "th11_Normal_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方地霊殿", "th11_Normal_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
          <tr>
            <td rowspan="2">H</td>
            <?php td("東方地霊殿", "th11_Hard_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方地霊殿", "th11_Hard_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方地霊殿", "th11_Hard_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方地霊殿", "th11_Hard_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方地霊殿", "th11_Hard_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方地霊殿", "th11_Hard_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
          <tr>
            <td rowspan="2">L</td>
            <?php td("東方地霊殿", "th11_Lunatic_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方地霊殿", "th11_Lunatic_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方地霊殿", "th11_Lunatic_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方地霊殿", "th11_Lunatic_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方地霊殿", "th11_Lunatic_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方地霊殿", "th11_Lunatic_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
          <tr>
            <td rowspan="2">X</td>
            <?php td("東方地霊殿", "th11_Extra_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方地霊殿", "th11_Extra_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方地霊殿", "th11_Extra_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方地霊殿", "th11_Extra_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方地霊殿", "th11_Extra_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方地霊殿", "th11_Extra_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
        </table>
      </td>
      <td>
        <!-- =============================================== 東方星蓮船 ================================================ -->
        <table class="ftable th12">
          <tr>
            <td rowspan="2">E</td>
            <?php td("東方星蓮船", "th12_Easy_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方星蓮船", "th12_Easy_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方星蓮船", "th12_Easy_SanaeA", "早A", "早苗A", true); ?>
          </tr>
          <tr>
            <?php td("東方星蓮船", "th12_Easy_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方星蓮船", "th12_Easy_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方星蓮船", "th12_Easy_SanaeB", "早B", "早苗B", true); ?>
          </tr>
          <tr>
            <td rowspan="2">N</td>
            <?php td("東方星蓮船", "th12_Normal_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方星蓮船", "th12_Normal_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方星蓮船", "th12_Normal_SanaeA", "早A", "早苗A", true); ?>
          </tr>
          <tr>
            <?php td("東方星蓮船", "th12_Normal_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方星蓮船", "th12_Normal_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方星蓮船", "th12_Normal_SanaeB", "早B", "早苗B", true); ?>
          </tr>
          <tr>
            <td rowspan="2">H</td>
            <?php td("東方星蓮船", "th12_Hard_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方星蓮船", "th12_Hard_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方星蓮船", "th12_Hard_SanaeA", "早A", "早苗A", true); ?>
          </tr>
          <tr>
            <?php td("東方星蓮船", "th12_Hard_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方星蓮船", "th12_Hard_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方星蓮船", "th12_Hard_SanaeB", "早B", "早苗B", true); ?>
          </tr>
          <tr>
            <td rowspan="2">L</td>
            <?php td("東方星蓮船", "th12_Lunatic_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方星蓮船", "th12_Lunatic_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方星蓮船", "th12_Lunatic_SanaeA", "早A", "早苗A", true); ?>
          </tr>
          <tr>
            <?php td("東方星蓮船", "th12_Lunatic_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方星蓮船", "th12_Lunatic_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方星蓮船", "th12_Lunatic_SanaeB", "早B", "早苗B", true); ?>
          </tr>
          <tr>
            <td rowspan="2">X</td>
            <?php td("東方星蓮船", "th12_Extra_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方星蓮船", "th12_Extra_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方星蓮船", "th12_Extra_SanaeA", "早A", "早苗A", true); ?>
          </tr>
          <tr>
            <?php td("東方星蓮船", "th12_Extra_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方星蓮船", "th12_Extra_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方星蓮船", "th12_Extra_SanaeB", "早B", "早苗B", true); ?>
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
    <tr>
      <td>
        <!-- =============================================== 東方神霊廟 ================================================ -->
        <table class="ftable th13">
          <tr>
            <td rowspan="2">E</td>
            <?php td("東方神霊廟", "th13_Easy_Reimu", "霊", "霊夢", true); ?>
            <?php td("東方神霊廟", "th13_Easy_Marisa", "魔", "魔理沙", true); ?>
          </tr>
          <tr>
            <?php td("東方神霊廟", "th13_Easy_Sanae", "早", "早苗", true); ?>
            <?php td("東方神霊廟", "th13_Easy_Youmu", "妖", "妖夢", true); ?>
          </tr>
          <tr>
            <td rowspan="2">N</td>
            <?php td("東方神霊廟", "th13_Normal_Reimu", "霊", "霊夢", true); ?>
            <?php td("東方神霊廟", "th13_Normal_Marisa", "魔", "魔理沙", true); ?>
          </tr>
          <tr>
            <?php td("東方神霊廟", "th13_Normal_Sanae", "早", "早苗", true); ?>
            <?php td("東方神霊廟", "th13_Normal_Youmu", "妖", "妖夢", true); ?>
          </tr>
          <tr>
            <td rowspan="2">H</td>
            <?php td("東方神霊廟", "th13_Hard_Reimu", "霊", "霊夢", true); ?>
            <?php td("東方神霊廟", "th13_Hard_Marisa", "魔", "魔理沙", true); ?>
          </tr>
          <tr>
            <?php td("東方神霊廟", "th13_Hard_Sanae", "早", "早苗", true); ?>
            <?php td("東方神霊廟", "th13_Hard_Youmu", "妖", "妖夢", true); ?>
          </tr>
          <tr>
            <td rowspan="2">L</td>
            <?php td("東方神霊廟", "th13_Lunatic_Reimu", "霊", "霊夢", true); ?>
            <?php td("東方神霊廟", "th13_Lunatic_Marisa", "魔", "魔理沙", true); ?>
          </tr>
          <tr>
            <?php td("東方神霊廟", "th13_Lunatic_Sanae", "早", "早苗", true); ?>
            <?php td("東方神霊廟", "th13_Lunatic_Youmu", "妖", "妖夢", true); ?>
          </tr>
          <tr>
            <td rowspan="2">X</td>
            <?php td("東方神霊廟", "th13_Extra_Reimu", "霊", "霊夢", true); ?>
            <?php td("東方神霊廟", "th13_Extra_Marisa", "魔", "魔理沙", true); ?>
          </tr>
          <tr>
            <?php td("東方神霊廟", "th13_Extra_Sanae", "早", "早苗", true); ?>
            <?php td("東方神霊廟", "th13_Extra_Youmu", "妖", "妖夢", true); ?>
          </tr>
        </table>
      </td>
      <td>
        <!-- =============================================== 東方輝針城 ================================================ -->
        <table class="ftable th14">
          <tr>
            <td rowspan="2">E</td>
            <?php td("東方輝針城", "th14_Easy_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方輝針城", "th14_Easy_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方輝針城", "th14_Easy_SakuyaA", "咲A", "咲夜A", false); ?>
          </tr>
          <tr>
            <?php td("東方輝針城", "th14_Easy_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方輝針城", "th14_Easy_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方輝針城", "th14_Easy_SakuyaB", "咲B", "咲夜B", false); ?>
          </tr>
          <tr>
            <td rowspan="2">N</td>
            <?php td("東方輝針城", "th14_Normal_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方輝針城", "th14_Normal_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方輝針城", "th14_Normal_SakuyaA", "咲A", "咲夜A", false); ?>
          </tr>
          <tr>
            <?php td("東方輝針城", "th14_Normal_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方輝針城", "th14_Normal_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方輝針城", "th14_Normal_SakuyaB", "咲B", "咲夜B", false); ?>
          </tr>
          <tr>
            <td rowspan="2">H</td>
            <?php td("東方輝針城", "th14_Hard_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方輝針城", "th14_Hard_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方輝針城", "th14_Hard_SakuyaA", "咲A", "咲夜A", false); ?>
          </tr>
          <tr>
            <?php td("東方輝針城", "th14_Hard_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方輝針城", "th14_Hard_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方輝針城", "th14_Hard_SakuyaB", "咲B", "咲夜B", false); ?>
          </tr>
          <tr>
            <td rowspan="2">L</td>
            <?php td("東方輝針城", "th14_Lunatic_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方輝針城", "th14_Lunatic_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方輝針城", "th14_Lunatic_SakuyaA", "咲A", "咲夜A", false); ?>
          </tr>
          <tr>
            <?php td("東方輝針城", "th14_Lunatic_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方輝針城", "th14_Lunatic_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方輝針城", "th14_Lunatic_SakuyaB", "咲B", "咲夜B", false); ?>
          </tr>
          <tr>
            <td rowspan="2">X</td>
            <?php td("東方輝針城", "th14_Extra_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方輝針城", "th14_Extra_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方輝針城", "th14_Extra_SakuyaA", "咲A", "咲夜A", false); ?>
          </tr>
          <tr>
            <?php td("東方輝針城", "th14_Extra_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方輝針城", "th14_Extra_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方輝針城", "th14_Extra_SakuyaB", "咲B", "咲夜B", false); ?>
          </tr>
        </table>
      </td>
      <td>
        <!-- =============================================== 東方紺珠伝 ================================================ -->
        <table class="ftable th15">
          <tr>
            <td rowspan="2">E</td>
            <?php td("東方紺珠伝", "th15_Easy_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方紺珠伝", "th15_Easy_Marisa", "魔", "魔理沙", false); ?>
          </tr>
          <tr>
            <?php td("東方紺珠伝", "th15_Easy_Sanae", "早", "早苗", false); ?>
            <?php td("東方紺珠伝", "th15_Easy_Youmu", "鈴", "鈴仙", false); ?>
          </tr>
          <tr>
            <td rowspan="2">N</td>
            <?php td("東方紺珠伝", "th15_Normal_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方紺珠伝", "th15_Normal_Marisa", "魔", "魔理沙", false); ?>
          </tr>
          <tr>
            <?php td("東方紺珠伝", "th15_Normal_Sanae", "早", "早苗", false); ?>
            <?php td("東方紺珠伝", "th15_Normal_Youmu", "鈴", "鈴仙", false); ?>
          </tr>
          <tr>
            <td rowspan="2">H</td>
            <?php td("東方紺珠伝", "th15_Hard_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方紺珠伝", "th15_Hard_Marisa", "魔", "魔理沙", false); ?>
          </tr>
          <tr>
            <?php td("東方紺珠伝", "th15_Hard_Sanae", "早", "早苗", false); ?>
            <?php td("東方紺珠伝", "th15_Hard_Youmu", "鈴", "鈴仙", false); ?>
          </tr>
          <tr>
            <td rowspan="2">L</td>
            <?php td("東方紺珠伝", "th15_Lunatic_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方紺珠伝", "th15_Lunatic_Marisa", "魔", "魔理沙", false); ?>
          </tr>
          <tr>
            <?php td("東方紺珠伝", "th15_Lunatic_Sanae", "早", "早苗", false); ?>
            <?php td("東方紺珠伝", "th15_Lunatic_Youmu", "鈴", "鈴仙", false); ?>
          </tr>
          <tr>
            <td rowspan="2">X</td>
            <?php td("東方紺珠伝", "th15_Extra_Reimu", "霊", "霊夢", false); ?>
            <?php td("東方紺珠伝", "th15_Extra_Marisa", "魔", "魔理沙", false); ?>
          </tr>
          <tr>
            <?php td("東方紺珠伝", "th15_Extra_Sanae", "早", "早苗", false); ?>
            <?php td("東方紺珠伝", "th15_Extra_Youmu", "鈴", "鈴仙", false); ?>
          </tr>
        </table>
      </td>
      <td>
        <!-- =============================================== 東方天空璋 ================================================ -->
        <table class="ftable th16">
          <tr>
            <td rowspan="4">E</td>
            <?php td("東方天空璋", "th16_Easy_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方天空璋", "th16_Easy_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方天空璋", "th16_Easy_ReimuC", "霊C", "霊夢C", true); ?>
            <?php td("東方天空璋", "th16_Easy_ReimuD", "霊D", "霊夢D", true); ?>
          </tr>
          <tr>
            <?php td("東方天空璋", "th16_Easy_CirnoA", "チA", "チルノA", true); ?>
            <?php td("東方天空璋", "th16_Easy_CirnoB", "チB", "チルノB", true); ?>
            <?php td("東方天空璋", "th16_Easy_CirnoC", "チC", "チルノC", true); ?>
            <?php td("東方天空璋", "th16_Easy_CirnoD", "チD", "チルノD", true); ?>
          </tr>
          <tr>
            <?php td("東方天空璋", "th16_Easy_AyaA", "文A", "文A", true); ?>
            <?php td("東方天空璋", "th16_Easy_AyaB", "文B", "文B", true); ?>
            <?php td("東方天空璋", "th16_Easy_AyaC", "文C", "文C", true); ?>
            <?php td("東方天空璋", "th16_Easy_AyaD", "文D", "文D", true); ?>
          </tr>
          <tr>
            <?php td("東方天空璋", "th16_Easy_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方天空璋", "th16_Easy_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方天空璋", "th16_Easy_MarisaC", "魔C", "魔理沙C", true); ?>
            <?php td("東方天空璋", "th16_Easy_MarisaD", "魔D", "魔理沙D", true); ?>
          </tr>
          <tr>
            <td rowspan="4">N</td>
            <?php td("東方天空璋", "th16_Normal_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方天空璋", "th16_Normal_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方天空璋", "th16_Normal_ReimuC", "霊C", "霊夢C", true); ?>
            <?php td("東方天空璋", "th16_Normal_ReimuD", "霊D", "霊夢D", true); ?>
          </tr>
          <tr>
            <?php td("東方天空璋", "th16_Normal_CirnoA", "チA", "チルノA", true); ?>
            <?php td("東方天空璋", "th16_Normal_CirnoB", "チB", "チルノB", true); ?>
            <?php td("東方天空璋", "th16_Normal_CirnoC", "チC", "チルノC", true); ?>
            <?php td("東方天空璋", "th16_Normal_CirnoD", "チD", "チルノD", true); ?>
          </tr>
          <tr>
            <?php td("東方天空璋", "th16_Normal_AyaA", "文A", "文A", true); ?>
            <?php td("東方天空璋", "th16_Normal_AyaB", "文B", "文B", true); ?>
            <?php td("東方天空璋", "th16_Normal_AyaC", "文C", "文C", true); ?>
            <?php td("東方天空璋", "th16_Normal_AyaD", "文D", "文D", true); ?>
          </tr>
          <tr>
            <?php td("東方天空璋", "th16_Normal_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方天空璋", "th16_Normal_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方天空璋", "th16_Normal_MarisaC", "魔C", "魔理沙C", true); ?>
            <?php td("東方天空璋", "th16_Normal_MarisaD", "魔D", "魔理沙D", true); ?>
          </tr>
          <tr>
            <td rowspan="4">H</td>
            <?php td("東方天空璋", "th16_Hard_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方天空璋", "th16_Hard_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方天空璋", "th16_Hard_ReimuC", "霊C", "霊夢C", true); ?>
            <?php td("東方天空璋", "th16_Hard_ReimuD", "霊D", "霊夢D", true); ?>
          </tr>
          <tr>
            <?php td("東方天空璋", "th16_Hard_CirnoA", "チA", "チルノA", true); ?>
            <?php td("東方天空璋", "th16_Hard_CirnoB", "チB", "チルノB", true); ?>
            <?php td("東方天空璋", "th16_Hard_CirnoC", "チC", "チルノC", true); ?>
            <?php td("東方天空璋", "th16_Hard_CirnoD", "チD", "チルノD", true); ?>
          </tr>
          <tr>
            <?php td("東方天空璋", "th16_Hard_AyaA", "文A", "文A", true); ?>
            <?php td("東方天空璋", "th16_Hard_AyaB", "文B", "文B", true); ?>
            <?php td("東方天空璋", "th16_Hard_AyaC", "文C", "文C", true); ?>
            <?php td("東方天空璋", "th16_Hard_AyaD", "文D", "文D", true); ?>
          </tr>
          <tr>
            <?php td("東方天空璋", "th16_Hard_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方天空璋", "th16_Hard_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方天空璋", "th16_Hard_MarisaC", "魔C", "魔理沙C", true); ?>
            <?php td("東方天空璋", "th16_Hard_MarisaD", "魔D", "魔理沙D", true); ?>
          </tr>
          <tr>
            <td rowspan="4">L</td>
            <?php td("東方天空璋", "th16_Lunatic_ReimuA", "霊A", "霊夢A", true); ?>
            <?php td("東方天空璋", "th16_Lunatic_ReimuB", "霊B", "霊夢B", true); ?>
            <?php td("東方天空璋", "th16_Lunatic_ReimuC", "霊C", "霊夢C", true); ?>
            <?php td("東方天空璋", "th16_Lunatic_ReimuD", "霊D", "霊夢D", true); ?>
          </tr>
          <tr>
            <?php td("東方天空璋", "th16_Lunatic_CirnoA", "チA", "チルノA", true); ?>
            <?php td("東方天空璋", "th16_Lunatic_CirnoB", "チB", "チルノB", true); ?>
            <?php td("東方天空璋", "th16_Lunatic_CirnoC", "チC", "チルノC", true); ?>
            <?php td("東方天空璋", "th16_Lunatic_CirnoD", "チD", "チルノD", true); ?>
          </tr>
          <tr>
            <?php td("東方天空璋", "th16_Lunatic_AyaA", "文A", "文A", true); ?>
            <?php td("東方天空璋", "th16_Lunatic_AyaB", "文B", "文B", true); ?>
            <?php td("東方天空璋", "th16_Lunatic_AyaC", "文C", "文C", true); ?>
            <?php td("東方天空璋", "th16_Lunatic_AyaD", "文D", "文D", true); ?>
          </tr>
          <tr>
            <?php td("東方天空璋", "th16_Lunatic_MarisaA", "魔A", "魔理沙A", true); ?>
            <?php td("東方天空璋", "th16_Lunatic_MarisaB", "魔B", "魔理沙B", true); ?>
            <?php td("東方天空璋", "th16_Lunatic_MarisaC", "魔C", "魔理沙C", true); ?>
            <?php td("東方天空璋", "th16_Lunatic_MarisaD", "魔D", "魔理沙D", true); ?>
          </tr>
          <tr>
            <td>X</td>
            <?php td("東方天空璋", "th16_Easy_Reimu", "霊", "霊夢", true); ?>
            <?php td("東方天空璋", "th16_Easy_Cirno", "チ", "チルノ", true); ?>
            <?php td("東方天空璋", "th16_Easy_Aya", "文", "文", true); ?>
            <?php td("東方天空璋", "th16_Easy_Marisa", "魔", "魔理沙", true); ?>
          </tr>
        </table>
      </td>
      <td>
        <!-- =============================================== 東方鬼形獣 ================================================ -->
        <table class="ftable th17">
          <tr>
            <td rowspan="3">E</td>
            <?php td("東方鬼形獣", "th17_Easy_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方鬼形獣", "th17_Easy_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方鬼形獣", "th17_Easy_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方鬼形獣", "th17_Easy_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方鬼形獣", "th17_Easy_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方鬼形獣", "th17_Easy_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
          <tr>
            <?php td("東方鬼形獣", "th17_Easy_YoumuA", "妖A", "妖々A", false); ?>
            <?php td("東方鬼形獣", "th17_Easy_YoumuB", "妖B", "妖々B", false); ?>
            <?php td("東方鬼形獣", "th17_Easy_YoumuC", "妖C", "妖々C", false); ?>
          </tr>
          <tr>
            <td rowspan="3">N</td>
            <?php td("東方鬼形獣", "th17_Normal_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方鬼形獣", "th17_Normal_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方鬼形獣", "th17_Normal_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方鬼形獣", "th17_Normal_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方鬼形獣", "th17_Normal_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方鬼形獣", "th17_Normal_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
          <tr>
            <?php td("東方鬼形獣", "th17_Normal_YoumuA", "妖A", "妖々A", false); ?>
            <?php td("東方鬼形獣", "th17_Normal_YoumuB", "妖B", "妖々B", false); ?>
            <?php td("東方鬼形獣", "th17_Normal_YoumuC", "妖C", "妖々C", false); ?>
          </tr>
          <tr>
            <td rowspan="3">H</td>
            <?php td("東方鬼形獣", "th17_Hard_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方鬼形獣", "th17_Hard_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方鬼形獣", "th17_Hard_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方鬼形獣", "th17_Hard_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方鬼形獣", "th17_Hard_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方鬼形獣", "th17_Hard_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
          <tr>
            <?php td("東方鬼形獣", "th17_Hard_YoumuA", "妖A", "妖々A", false); ?>
            <?php td("東方鬼形獣", "th17_Hard_YoumuB", "妖B", "妖々B", false); ?>
            <?php td("東方鬼形獣", "th17_Hard_YoumuC", "妖C", "妖々C", false); ?>
          </tr>
          <tr>
            <td rowspan="3">L</td>
            <?php td("東方鬼形獣", "th17_Lunatic_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方鬼形獣", "th17_Lunatic_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方鬼形獣", "th17_Lunatic_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方鬼形獣", "th17_Lunatic_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方鬼形獣", "th17_Lunatic_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方鬼形獣", "th17_Lunatic_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
          <tr>
            <?php td("東方鬼形獣", "th17_Lunatic_YoumuA", "妖A", "妖々A", false); ?>
            <?php td("東方鬼形獣", "th17_Lunatic_YoumuB", "妖B", "妖々B", false); ?>
            <?php td("東方鬼形獣", "th17_Lunatic_YoumuC", "妖C", "妖々C", false); ?>
          </tr>
          <tr>
            <td rowspan="3">X</td>
            <?php td("東方鬼形獣", "th17_Extra_ReimuA", "霊A", "霊夢A", false); ?>
            <?php td("東方鬼形獣", "th17_Extra_ReimuB", "霊B", "霊夢B", false); ?>
            <?php td("東方鬼形獣", "th17_Extra_ReimuC", "霊C", "霊夢C", false); ?>
          </tr>
          <tr>
            <?php td("東方鬼形獣", "th17_Extra_MarisaA", "魔A", "魔理沙A", false); ?>
            <?php td("東方鬼形獣", "th17_Extra_MarisaB", "魔B", "魔理沙B", false); ?>
            <?php td("東方鬼形獣", "th17_Extra_MarisaC", "魔C", "魔理沙C", false); ?>
          </tr>
          <tr>
            <?php td("東方鬼形獣", "th17_Extra_YoumuA", "妖A", "妖々A", false); ?>
            <?php td("東方鬼形獣", "th17_Extra_YoumuB", "妖B", "妖々B", false); ?>
            <?php td("東方鬼形獣", "th17_Extra_YoumuC", "妖C", "妖々C", false); ?>
          </tr>
        </table>
      </td>
      <td>
        <!-- =============================================== 東方虹龍洞 ================================================ -->
        <table class="ftable th18">
          <tr>
            <td rowspan="2">E</td>
            <?php td("東方虹龍洞", "th18_Easy_Reimu", "霊", "霊夢", true); ?>
            <?php td("東方虹龍洞", "th18_Easy_Marisa", "魔", "魔理沙", true); ?>
          </tr>
          <tr>
            <?php td("東方虹龍洞", "th18_Easy_Sanae", "早", "早苗", true); ?>
            <?php td("東方虹龍洞", "th18_Easy_Youmu", "咲", "咲夜", true); ?>
          </tr>
          <tr>
            <td rowspan="2">N</td>
            <?php td("東方虹龍洞", "th18_Normal_Reimu", "霊", "霊夢", true); ?>
            <?php td("東方虹龍洞", "th18_Normal_Marisa", "魔", "魔理沙", true); ?>
          </tr>
          <tr>
            <?php td("東方虹龍洞", "th18_Normal_Sanae", "早", "早苗", true); ?>
            <?php td("東方虹龍洞", "th18_Normal_Youmu", "咲", "咲夜", true); ?>
          </tr>
          <tr>
            <td rowspan="2">H</td>
            <?php td("東方虹龍洞", "th18_Hard_Reimu", "霊", "霊夢", true); ?>
            <?php td("東方虹龍洞", "th18_Hard_Marisa", "魔", "魔理沙", true); ?>
          </tr>
          <tr>
            <?php td("東方虹龍洞", "th18_Hard_Sanae", "早", "早苗", true); ?>
            <?php td("東方虹龍洞", "th18_Hard_Youmu", "咲", "咲夜", true); ?>
          </tr>
          <tr>
            <td rowspan="2">L</td>
            <?php td("東方虹龍洞", "th18_Lunatic_Reimu", "霊", "霊夢", true); ?>
            <?php td("東方虹龍洞", "th18_Lunatic_Marisa", "魔", "魔理沙", true); ?>
          </tr>
          <tr>
            <?php td("東方虹龍洞", "th18_Lunatic_Sanae", "早", "早苗", true); ?>
            <?php td("東方虹龍洞", "th18_Lunatic_Youmu", "咲", "咲夜", true); ?>
          </tr>
          <tr>
            <td rowspan="2">X</td>
            <?php td("東方虹龍洞", "th18_Extra_Reimu", "霊", "霊夢", true); ?>
            <?php td("東方虹龍洞", "th18_Extra_Marisa", "魔", "魔理沙", true); ?>
          </tr>
          <tr>
            <?php td("東方虹龍洞", "th18_Extra_Sanae", "早", "早苗", true); ?>
            <?php td("東方虹龍洞", "th18_Extra_Youmu", "咲", "咲夜", true); ?>
          </tr>
        </table>
      </td>
      <td>
        <table class="ftable color">
          <tr>
            <td class="nmnbnr">NMNBNR</td>
          </tr>
          <tr>
            <td class="nmnb">NMNB</td>
          </tr>
          <tr>
            <td class="nm">NM</td>
          </tr>
          <tr>
            <td class="nbnr">NBNR</td>
          </tr>
          <tr>
            <td class="nb">NB</td>
          </tr>
          <tr>
            <td class="c">ALL</td>
          </tr>
          <tr>
            <td>not-cleared</td>
          </tr>
        </table>
      </td>
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