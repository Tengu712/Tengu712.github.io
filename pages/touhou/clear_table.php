<?php

function trim_filename($path) {
  $arr = explode("/", $path);
  $end = end($arr);
  return $end;
}

function insert_slash($date) {
  $res = substr($date, 0, 4);
  $res .= '/';
  $res .= substr($date, 4, 2);
  $res .= '/';
  $res .= substr($date, 6);
  return $res;
}

function th6($header) {
  $file = glob($_SERVER['DOCUMENT_ROOT'] . "/data/threplay/" . $header . "*.rpy");
  if (empty($file)) {
    return;
  }
  $filename = trim_filename($file[0]);
  $splitted = explode("_", $filename);
  $diff = $splitted[1];
  $play = $
  echo $filename;
}

?>

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
  <p>SKD(天狗)の東方整数作品のクリア機体表兼リプレイ置き場です。</p>
  <p>NBについて、3M以内であれば特筆してあります。</p>
  <p>スコアタは紅EX魔Bしかやっていないので無しで。</p>
  <hr>
</div>

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
        <table class="th6">
          <tr>
            <td rowspan="2">E</td>
            <td><?php th6("th6_Easy_ReimuA"); ?></td>
            <td><?php th6("th6_Easy_ReimuB"); ?></td>
          </tr>
          <tr>
            <td><?php th6("th6_Easy_MarisaA"); ?></td>
            <td><?php th6("th6_Easy_MarisaB"); ?></td>
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