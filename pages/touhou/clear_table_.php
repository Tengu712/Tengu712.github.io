<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>東方整数作品クリア機体シート</title>
    <style>
        body {
            background-color: black;
            color: white;
        }
        a, a:visited {
            color: red;
        }
        table {
            margin-bottom: 24px;
        }
        table, th, td {
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
        td > a, td > a:visited {
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
        div#popup > p.link {
            text-align: center;
        }
    </style>
</head>

<body>

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
            const a_link = document.createElement("a");
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
            div.onclick = (e) => {
                e.stopPropagation();
            }
        }
        document.body.onclick = () => {
            if (div !== null) {
                document.body.removeChild(div);
                div = null;
            }
        };
    </script>

    <center>



<?php

$statusclasses = array(
  'th6' => array(
    'NMNB' => 'nmnbnr',
    'NM' => 'nm',
    'NB' => 'nbnr'
  ),
  'th7' => array(
    'NMNBNR' => 'nmnbnr',
    'NMNB' => 'nmnb',
    'NM' => 'nm',
    'NBNR' => 'nbnr',
    'NB' => 'nb'
  ),
  'th8' => array(
    'NMNB' => 'nmnbnr',
    'NM' => 'nm',
    'NB' => 'nbnr'
  ),
  'th9' => array(
    'NMNB' => 'nmnbnr',
    'NM' => 'nm',
    'NB' => 'nbnr',
  ),
  'th10' => array(
    'NMNB' => 'nmnbnr',
    'NM' => 'nm',
    'NB' => 'nbnr'
  ),
  'th11' => array(
    'NMNB' => 'nmnbnr',
    'NM' => 'nm',
    'NB' => 'nbnr'
  ),
  'th12' => array(
    'NMNBNV' => 'nmnbnr',
    'NMNB' => 'nmnb',
    'NM' => 'nm',
    'NBNV' => 'nbnr',
    'NB' => 'nb'
  ),
);

$titles = array(
  'th6' => '東方紅魔郷',
  'th7' => '東方妖々夢',
  'th8' => '東方永夜抄',
  'th9' => '東方花映塚',
  'th10' => '東方風神録',
  'th11' => '東方地霊殿',
  'th12' => '東方星蓮船',
  'th13' => '東方神霊廟',
  'th14' => '東方輝針城',
  'th15' => '東方紺珠伝',
  'th16' => '東方天空璋',
  'th17' => '東方鬼形獣',
  'th18' => '東方虹龍洞',
);

$charas = array(
  'ReimuA' => '霊夢A',
  'ReimuB' => '霊夢B',
  'MarisaA' => '魔理沙A',
  'MarisaB' => '魔理沙B',
  'SakuyaA' => '咲夜A',
  'SakuyaB' => '咲夜A',
  'Kekkai' => '結界組',
  'Eishou' => '詠唱組',
  'Kouma' => '紅魔組',
  'Yumei' => '幽冥組',
  'Reimu' => '霊夢',
  'Yukari' => '紫',
  'Marisa' => '魔理沙',
  'Alice' => 'アリス',
  'Sakuya' => '咲夜',
  'Remilia' => 'レミリア',
  'Youmu' => '妖夢',
  'Yuyuko' => '幽々子',
  'ReimuC' => '霊夢C',
  'MarisaC' => '魔理沙C',
  'SanaeA' => '早苗A',
  'SanaeB' => '早苗B',
);

$map = array();

function insert_slash($date) {
    $res = substr($date, 0, 4);
    $res .= '/';
    $res .= substr($date, 4, 2);
    $res .= '/';
    $res .= substr($date, 6);
    return $res;
}

function echo_td_with_color($title, $status) {
    global $statusclasses;
    if ($status === '') {
        echo '<td>';
        return;
    }
    echo '<td ';
    foreach ($statusclasses[$title] as $k_substr => $v_class) {
        if (strpos($status, $k_substr) !== false) {
            echo 'class="';
            echo $v_class;
            echo '">';
            return;
        }
    }
    echo 'class="c">';
}

$lines = array();
$root = $_SERVER['DOCUMENT_ROOT'];
exec("ls -1 " . $root . "/data/threplay", $lines);

echo $root . "/data/threplay";

$replay_count = count($lines);
$registered_count = 0;

foreach ($lines as $line) {
    $datum = explode("_", $line);
    if (is_null($map[$datum[0]])) {
        $map[$datum[0]] = array();
    }
    if (is_null($map[$datum[0]][$datum[1]])) {
        $map[$datum[0]][$datum[1]] = array();
    }
    $map[$datum[0]][$datum[1]][$datum[2]] = array($datum[3], insert_slash(substr($datum[4], 0, 8)), $line);
    $registered_count += 1;
}

if ($replay_count !== $registered_count) {
    echo '<script> alert("リプレイの数と登録された情報の数が合いません。"); </script>';
}

$shown_count = 0;

// ================================================================================================== //
//     table                                                                                          //
// ================================================================================================== //

$type = isset($_GET['type']) ? $_GET['type'] : '';

if ($type === 'table') {

    function echo_cell($title, $diff, $chara) {
        global $map;
        global $shown_count;
        if (is_null($map[$title][$diff][$chara])) {
            echo '<td></td>';
            return;
        }
        $status = $map[$title][$diff][$chara][0];
        echo_td_with_color($title, $status);
        echo $status;
        echo '</td>';
        $shown_count += 1;
    }

    echo '<p>表表示</p>';

// TH6

    echo '<table>';
        echo '<tr><td>東方紅魔郷</td><td>霊夢A</td><td>霊夢B</td><td>魔理沙A</td><td>魔理沙B</td></tr>';
        echo '<tr>';
            echo '<td>Easy</td>';
            echo_cell('th6', 'Easy', 'ReimuA');
            echo_cell('th6', 'Easy', 'ReimuB');
            echo_cell('th6', 'Easy', 'MarisaA');
            echo_cell('th6', 'Easy', 'MarisaB');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Normal</td>';
            echo_cell('th6', 'Normal', 'ReimuA');
            echo_cell('th6', 'Normal', 'ReimuB');
            echo_cell('th6', 'Normal', 'MarisaA');
            echo_cell('th6', 'Normal', 'MarisaB');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Hard</td>';
            echo_cell('th6', 'Hard', 'ReimuA');
            echo_cell('th6', 'Hard', 'ReimuB');
            echo_cell('th6', 'Hard', 'MarisaA');
            echo_cell('th6', 'Hard', 'MarisaB');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Lunatic</td>';
            echo_cell('th6', 'Lunatic', 'ReimuA');
            echo_cell('th6', 'Lunatic', 'ReimuB');
            echo_cell('th6', 'Lunatic', 'MarisaA');
            echo_cell('th6', 'Lunatic', 'MarisaB');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Extra</td>';
            echo_cell('th6', 'Extra', 'ReimuA');
            echo_cell('th6', 'Extra', 'ReimuB');
            echo_cell('th6', 'Extra', 'MarisaA');
            echo_cell('th6', 'Extra', 'MarisaB');
        echo '</tr>';

// TH7

    echo '<table>';
        echo '<tr><td>東方妖々夢</td><td>霊夢A</td><td>霊夢B</td><td>魔理沙A</td><td>魔理沙B</td><td>咲夜A</td><td>咲夜B</td></tr>';
        echo '<tr>';
            echo '<td>Easy</td>';
            echo_cell('th7', 'Easy', 'ReimuA');
            echo_cell('th7', 'Easy', 'ReimuB');
            echo_cell('th7', 'Easy', 'MarisaA');
            echo_cell('th7', 'Easy', 'MarisaB');
            echo_cell('th7', 'Easy', 'SakuyaA');
            echo_cell('th7', 'Easy', 'SakuyaB');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Normal</td>';
            echo_cell('th7', 'Normal', 'ReimuA');
            echo_cell('th7', 'Normal', 'ReimuB');
            echo_cell('th7', 'Normal', 'MarisaA');
            echo_cell('th7', 'Normal', 'MarisaB');
            echo_cell('th7', 'Normal', 'SakuyaA');
            echo_cell('th7', 'Normal', 'SakuyaB');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Hard</td>';
            echo_cell('th7', 'Hard', 'ReimuA');
            echo_cell('th7', 'Hard', 'ReimuB');
            echo_cell('th7', 'Hard', 'MarisaA');
            echo_cell('th7', 'Hard', 'MarisaB');
            echo_cell('th7', 'Hard', 'SakuyaA');
            echo_cell('th7', 'Hard', 'SakuyaB');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Lunatic</td>';
            echo_cell('th7', 'Lunatic', 'ReimuA');
            echo_cell('th7', 'Lunatic', 'ReimuB');
            echo_cell('th7', 'Lunatic', 'MarisaA');
            echo_cell('th7', 'Lunatic', 'MarisaB');
            echo_cell('th7', 'Lunatic', 'SakuyaA');
            echo_cell('th7', 'Lunatic', 'SakuyaB');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Extra</td>';
            echo_cell('th7', 'Extra', 'ReimuA');
            echo_cell('th7', 'Extra', 'ReimuB');
            echo_cell('th7', 'Extra', 'MarisaA');
            echo_cell('th7', 'Extra', 'MarisaB');
            echo_cell('th7', 'Extra', 'SakuyaA');
            echo_cell('th7', 'Extra', 'SakuyaB');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Phantasm</td>';
            echo_cell('th7', 'Phantasm', 'ReimuA');
            echo_cell('th7', 'Phantasm', 'ReimuB');
            echo_cell('th7', 'Phantasm', 'MarisaA');
            echo_cell('th7', 'Phantasm', 'MarisaB');
            echo_cell('th7', 'Phantasm', 'SakuyaA');
            echo_cell('th7', 'Phantasm', 'SakuyaB');
        echo '</tr>';
    echo '</table>';

// TH8

    echo '<table>';
        echo '<tr><td>東方永夜抄</td><td>結界組</td><td>詠唱組</td><td>紅魔組</td><td>幽冥組</td><td>霊夢</td><td>紫</td><td>魔理沙</td><td>アリス</td><td>咲夜</td><td>レミリア</td><td>妖夢</td><td>幽々子</td></tr>';
        echo '<tr>';
            echo '<td>Easy</td>';
            echo_cell('th8', 'Easy', 'Kekkai');
            echo_cell('th8', 'Easy', 'Eishou');
            echo_cell('th8', 'Easy', 'Kouma');
            echo_cell('th8', 'Easy', 'Yumei');
            echo_cell('th8', 'Easy', 'Reimu');
            echo_cell('th8', 'Easy', 'Yukari');
            echo_cell('th8', 'Easy', 'Marisa');
            echo_cell('th8', 'Easy', 'Alice');
            echo_cell('th8', 'Easy', 'Sakuya');
            echo_cell('th8', 'Easy', 'Remilia');
            echo_cell('th8', 'Easy', 'Youmu');
            echo_cell('th8', 'Easy', 'Yuyuko');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Normal</td>';
            echo_cell('th8', 'Normal', 'Kekkai');
            echo_cell('th8', 'Normal', 'Eishou');
            echo_cell('th8', 'Normal', 'Kouma');
            echo_cell('th8', 'Normal', 'Yumei');
            echo_cell('th8', 'Normal', 'Reimu');
            echo_cell('th8', 'Normal', 'Yukari');
            echo_cell('th8', 'Normal', 'Marisa');
            echo_cell('th8', 'Normal', 'Alice');
            echo_cell('th8', 'Normal', 'Sakuya');
            echo_cell('th8', 'Normal', 'Remilia');
            echo_cell('th8', 'Normal', 'Youmu');
            echo_cell('th8', 'Normal', 'Yuyuko');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Hard</td>';
            echo_cell('th8', 'Hard', 'Kekkai');
            echo_cell('th8', 'Hard', 'Eishou');
            echo_cell('th8', 'Hard', 'Kouma');
            echo_cell('th8', 'Hard', 'Yumei');
            echo_cell('th8', 'Hard', 'Reimu');
            echo_cell('th8', 'Hard', 'Yukari');
            echo_cell('th8', 'Hard', 'Marisa');
            echo_cell('th8', 'Hard', 'Alice');
            echo_cell('th8', 'Hard', 'Sakuya');
            echo_cell('th8', 'Hard', 'Remilia');
            echo_cell('th8', 'Hard', 'Youmu');
            echo_cell('th8', 'Hard', 'Yuyuko');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Lunatic</td>';
            echo_cell('th8', 'Lunatic', 'Kekkai');
            echo_cell('th8', 'Lunatic', 'Eishou');
            echo_cell('th8', 'Lunatic', 'Kouma');
            echo_cell('th8', 'Lunatic', 'Yumei');
            echo_cell('th8', 'Lunatic', 'Reimu');
            echo_cell('th8', 'Lunatic', 'Yukari');
            echo_cell('th8', 'Lunatic', 'Marisa');
            echo_cell('th8', 'Lunatic', 'Alice');
            echo_cell('th8', 'Lunatic', 'Sakuya');
            echo_cell('th8', 'Lunatic', 'Remilia');
            echo_cell('th8', 'Lunatic', 'Youmu');
            echo_cell('th8', 'Lunatic', 'Yuyuko');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Extra</td>';
            echo_cell('th8', 'Extra', 'Kekkai');
            echo_cell('th8', 'Extra', 'Eishou');
            echo_cell('th8', 'Extra', 'Kouma');
            echo_cell('th8', 'Extra', 'Yumei');
            echo_cell('th8', 'Extra', 'Reimu');
            echo_cell('th8', 'Extra', 'Yukari');
            echo_cell('th8', 'Extra', 'Marisa');
            echo_cell('th8', 'Extra', 'Alice');
            echo_cell('th8', 'Extra', 'Sakuya');
            echo_cell('th8', 'Extra', 'Remilia');
            echo_cell('th8', 'Extra', 'Youmu');
            echo_cell('th8', 'Extra', 'Yuyuko');
        echo '</tr>';
    echo '</table>';

// TH9

    echo '<table>';
    echo '</table>';

// TH10

    echo '<table>';
        echo '<tr><td>東方風神録</td><td>霊夢A</td><td>霊夢B</td><td>霊夢C</td><td>魔理沙A</td><td>魔理沙B</td><td>魔理沙C</td></tr>';
        echo '<tr>';
            echo '<td>Easy</td>';
            echo_cell('th10', 'Easy', 'ReimuA');
            echo_cell('th10', 'Easy', 'ReimuB');
            echo_cell('th10', 'Easy', 'ReimuC');
            echo_cell('th10', 'Easy', 'MarisaA');
            echo_cell('th10', 'Easy', 'MarisaB');
            echo_cell('th10', 'Easy', 'MarisaC');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Normal</td>';
            echo_cell('th10', 'Normal', 'ReimuA');
            echo_cell('th10', 'Normal', 'ReimuB');
            echo_cell('th10', 'Normal', 'ReimuC');
            echo_cell('th10', 'Normal', 'MarisaA');
            echo_cell('th10', 'Normal', 'MarisaB');
            echo_cell('th10', 'Normal', 'MarisaC');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Hard</td>';
            echo_cell('th10', 'Hard', 'ReimuA');
            echo_cell('th10', 'Hard', 'ReimuB');
            echo_cell('th10', 'Hard', 'ReimuC');
            echo_cell('th10', 'Hard', 'MarisaA');
            echo_cell('th10', 'Hard', 'MarisaB');
            echo_cell('th10', 'Hard', 'MarisaC');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Lunatic</td>';
            echo_cell('th10', 'Lunatic', 'ReimuA');
            echo_cell('th10', 'Lunatic', 'ReimuB');
            echo_cell('th10', 'Lunatic', 'ReimuC');
            echo_cell('th10', 'Lunatic', 'MarisaA');
            echo_cell('th10', 'Lunatic', 'MarisaB');
            echo_cell('th10', 'Lunatic', 'MarisaC');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Extra</td>';
            echo_cell('th10', 'Extra', 'ReimuA');
            echo_cell('th10', 'Extra', 'ReimuB');
            echo_cell('th10', 'Extra', 'ReimuC');
            echo_cell('th10', 'Extra', 'MarisaA');
            echo_cell('th10', 'Extra', 'MarisaB');
            echo_cell('th10', 'Extra', 'MarisaC');
        echo '</tr>';
    echo '</table>';

// TH11

    echo '<table>';
        echo '<tr><td>東方地霊殿</td><td>霊夢A</td><td>霊夢B</td><td>霊夢C</td><td>魔理沙A</td><td>魔理沙B</td><td>魔理沙C</td></tr>';
        echo '<tr>';
            echo '<td>Easy</td>';
            echo_cell('th11', 'Easy', 'ReimuA');
            echo_cell('th11', 'Easy', 'ReimuB');
            echo_cell('th11', 'Easy', 'ReimuC');
            echo_cell('th11', 'Easy', 'MarisaA');
            echo_cell('th11', 'Easy', 'MarisaB');
            echo_cell('th11', 'Easy', 'MarisaC');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Normal</td>';
            echo_cell('th11', 'Normal', 'ReimuA');
            echo_cell('th11', 'Normal', 'ReimuB');
            echo_cell('th11', 'Normal', 'ReimuC');
            echo_cell('th11', 'Normal', 'MarisaA');
            echo_cell('th11', 'Normal', 'MarisaB');
            echo_cell('th11', 'Normal', 'MarisaC');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Hard</td>';
            echo_cell('th11', 'Hard', 'ReimuA');
            echo_cell('th11', 'Hard', 'ReimuB');
            echo_cell('th11', 'Hard', 'ReimuC');
            echo_cell('th11', 'Hard', 'MarisaA');
            echo_cell('th11', 'Hard', 'MarisaB');
            echo_cell('th11', 'Hard', 'MarisaC');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Lunatic</td>';
            echo_cell('th11', 'Lunatic', 'ReimuA');
            echo_cell('th11', 'Lunatic', 'ReimuB');
            echo_cell('th11', 'Lunatic', 'ReimuC');
            echo_cell('th11', 'Lunatic', 'MarisaA');
            echo_cell('th11', 'Lunatic', 'MarisaB');
            echo_cell('th11', 'Lunatic', 'MarisaC');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Extra</td>';
            echo_cell('th11', 'Extra', 'ReimuA');
            echo_cell('th11', 'Extra', 'ReimuB');
            echo_cell('th11', 'Extra', 'ReimuC');
            echo_cell('th11', 'Extra', 'MarisaA');
            echo_cell('th11', 'Extra', 'MarisaB');
            echo_cell('th11', 'Extra', 'MarisaC');
        echo '</tr>';
    echo '</table>';

// TH12

    echo '<table>';
        echo '<tr><td>東方星蓮船</td><td>霊夢A</td><td>霊夢B</td><td>魔理沙A</td><td>魔理沙B</td><td>早苗A</td><td>早苗B</td></tr>';
        echo '<tr>';
            echo '<td>Easy</td>';
            echo_cell('th12', 'Easy', 'ReimuA');
            echo_cell('th12', 'Easy', 'ReimuB');
            echo_cell('th12', 'Easy', 'MarisaA');
            echo_cell('th12', 'Easy', 'MarisaB');
            echo_cell('th12', 'Easy', 'SanaeA');
            echo_cell('th12', 'Easy', 'SanaeB');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Normal</td>';
            echo_cell('th12', 'Normal', 'ReimuA');
            echo_cell('th12', 'Normal', 'ReimuB');
            echo_cell('th12', 'Normal', 'MarisaA');
            echo_cell('th12', 'Normal', 'MarisaB');
            echo_cell('th12', 'Normal', 'SanaeA');
            echo_cell('th12', 'Normal', 'SanaeB');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Hard</td>';
            echo_cell('th12', 'Hard', 'ReimuA');
            echo_cell('th12', 'Hard', 'ReimuB');
            echo_cell('th12', 'Hard', 'MarisaA');
            echo_cell('th12', 'Hard', 'MarisaB');
            echo_cell('th12', 'Hard', 'SanaeA');
            echo_cell('th12', 'Hard', 'SanaeB');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Lunatic</td>';
            echo_cell('th12', 'Lunatic', 'ReimuA');
            echo_cell('th12', 'Lunatic', 'ReimuB');
            echo_cell('th12', 'Lunatic', 'MarisaA');
            echo_cell('th12', 'Lunatic', 'MarisaB');
            echo_cell('th12', 'Lunatic', 'SanaeA');
            echo_cell('th12', 'Lunatic', 'SanaeB');
        echo '</tr>';
        echo '<tr>';
            echo '<td>Extra</td>';
            echo_cell('th12', 'Extra', 'ReimuA');
            echo_cell('th12', 'Extra', 'ReimuB');
            echo_cell('th12', 'Extra', 'MarisaA');
            echo_cell('th12', 'Extra', 'MarisaB');
            echo_cell('th12', 'Extra', 'SanaeA');
            echo_cell('th12', 'Extra', 'SanaeB');
        echo '</tr>';
    echo '</table>';

}

// ================================================================================================== //
//     ftable                                                                                         //
// ================================================================================================== //

else {

    function echo_cell($title, $diff, $chara, $chara_) {
        global $map;
        global $titles;
        global $charas;
        global $shown_count;
        if (is_null($map[$title][$diff][$chara][2])) {
            echo '<td>';
            echo $chara_;
            echo '</td>';
            return;
        }
        echo_td_with_color($title, $map[$title][$diff][$chara][0]);
        echo '<a href="javascript:open_popup(\'';
        echo $titles[$title];
        echo '\', \'';
        echo $diff;
        echo '\', \'';
        echo $charas[$chara];
        echo '\', \'';
        echo $map[$title][$diff][$chara][0];
        echo '\', \'';
        echo $map[$title][$diff][$chara][1];
        echo '\', \'';
        echo $map[$title][$diff][$chara][2];
        echo '\');">';
        echo $chara_;
        echo '</a>';
        $shown_count += 1;
    }

    echo '<p>簡易表表示</p>';
    echo '<table class="ftable">';
        echo '<tr>';
            echo '<td>紅魔郷</td>';
            echo '<td>妖々夢</td>';
            echo '<td>永夜抄</td>';
            echo '<td>花映塚</td>';
            echo '<td>風神録</td>';
            echo '<td>地霊殿</td>';
            echo '<td>星蓮船</td>';
        echo '</tr>';
        echo '<tr>';
// TH6
            echo '<td>';
                echo '<table class="ftable th6">';
                    echo '<tr>';
                        echo '<td rowspan="2">E</td>';
                        echo_cell('th6', 'Easy', 'ReimuA', '霊A');
                        echo_cell('th6', 'Easy', 'ReimuB', '霊B');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th6', 'Easy', 'MarisaA', '魔A');
                        echo_cell('th6', 'Easy', 'MarisaB', '魔B');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">N</td>';
                        echo_cell('th6', 'Normal', 'ReimuA', '霊A');
                        echo_cell('th6', 'Normal', 'ReimuB', '霊B');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th6', 'Normal', 'MarisaA', '魔A');
                        echo_cell('th6', 'Normal', 'MarisaB', '魔B');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">H</td>';
                        echo_cell('th6', 'Hard', 'ReimuA', '霊A');
                        echo_cell('th6', 'Hard', 'ReimuB', '霊B');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th6', 'Hard', 'MarisaA', '魔A');
                        echo_cell('th6', 'Hard', 'MarisaB', '魔B');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">L</td>';
                        echo_cell('th6', 'Lunatic', 'ReimuA', '霊A');
                        echo_cell('th6', 'Lunatic', 'ReimuB', '霊B');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th6', 'Lunatic', 'MarisaA', '魔A');
                        echo_cell('th6', 'Lunatic', 'MarisaB', '魔B');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">X</td>';
                        echo_cell('th6', 'Extra', 'ReimuA', '霊A');
                        echo_cell('th6', 'Extra', 'ReimuB', '霊B');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th6', 'Extra', 'MarisaA', '魔A');
                        echo_cell('th6', 'Extra', 'MarisaB', '魔B');
                    echo '</tr>';
                echo '</table>';
// TH7
            echo '<td>';
                echo '<table class="ftable th7">';
                    echo '<tr>';
                        echo '<td rowspan="2">E</td>';
                        echo_cell('th7', 'Easy', 'ReimuA', '霊A');
                        echo_cell('th7', 'Easy', 'MarisaA', '魔A');
                        echo_cell('th7', 'Easy', 'SakuyaA', '咲A');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th7', 'Easy', 'ReimuB', '霊B');
                        echo_cell('th7', 'Easy', 'MarisaB', '魔B');
                        echo_cell('th7', 'Easy', 'SakuyaB', '咲B');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">N</td>';
                        echo_cell('th7', 'Normal', 'ReimuA', '霊A');
                        echo_cell('th7', 'Normal', 'MarisaA', '魔A');
                        echo_cell('th7', 'Normal', 'SakuyaA', '咲A');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th7', 'Normal', 'ReimuB', '霊B');
                        echo_cell('th7', 'Normal', 'MarisaB', '魔B');
                        echo_cell('th7', 'Normal', 'SakuyaB', '咲B');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">H</td>';
                        echo_cell('th7', 'Hard', 'ReimuA', '霊A');
                        echo_cell('th7', 'Hard', 'MarisaA', '魔A');
                        echo_cell('th7', 'Hard', 'SakuyaA', '咲A');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th7', 'Hard', 'ReimuB', '霊B');
                        echo_cell('th7', 'Hard', 'MarisaB', '魔B');
                        echo_cell('th7', 'Hard', 'SakuyaB', '咲B');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">L</td>';
                        echo_cell('th7', 'Lunatic', 'ReimuA', '霊A');
                        echo_cell('th7', 'Lunatic', 'MarisaA', '魔A');
                        echo_cell('th7', 'Lunatic', 'SakuyaA', '咲A');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th7', 'Lunatic', 'ReimuB', '霊B');
                        echo_cell('th7', 'Lunatic', 'MarisaB', '魔B');
                        echo_cell('th7', 'Lunatic', 'SakuyaB', '咲B');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">X</td>';
                        echo_cell('th7', 'Extra', 'ReimuA', '霊A');
                        echo_cell('th7', 'Extra', 'MarisaA', '魔A');
                        echo_cell('th7', 'Extra', 'SakuyaA', '咲A');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th7', 'Extra', 'ReimuB', '霊B');
                        echo_cell('th7', 'Extra', 'MarisaB', '魔B');
                        echo_cell('th7', 'Extra', 'SakuyaB', '咲B');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">P</td>';
                        echo_cell('th7', 'Phantasm', 'ReimuA', '霊A');
                        echo_cell('th7', 'Phantasm', 'MarisaA', '魔A');
                        echo_cell('th7', 'Phantasm', 'SakuyaA', '咲A');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th7', 'Phantasm', 'ReimuB', '霊B');
                        echo_cell('th7', 'Phantasm', 'MarisaB', '魔B');
                        echo_cell('th7', 'Phantasm', 'SakuyaB', '咲B');
                    echo '</tr>';
                echo '</table>';
// TH8
            echo '<td>';
                echo '<table class="ftable th8">';
                    echo '<tr>';
                        echo '<td rowspan="3">E</td>';
                        echo_cell('th8', 'Easy', 'Kekkai', '結');
                        echo_cell('th8', 'Easy', 'Eishou', '詠');
                        echo_cell('th8', 'Easy', 'Kouma', '紅');
                        echo_cell('th8', 'Easy', 'Yumei', '冥');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th8', 'Easy', 'Reimu', '霊');
                        echo_cell('th8', 'Easy', 'Marisa', '魔');
                        echo_cell('th8', 'Easy', 'Sakuya', '咲');
                        echo_cell('th8', 'Easy', 'Youmu', '妖');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th8', 'Easy', 'Yukari', '紫');
                        echo_cell('th8', 'Easy', 'Alice', 'ア');
                        echo_cell('th8', 'Easy', 'Remilia', 'レ');
                        echo_cell('th8', 'Easy', 'Yuyuko', '幽');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="3">N</td>';
                        echo_cell('th8', 'Normal', 'Kekkai', '結');
                        echo_cell('th8', 'Normal', 'Eishou', '詠');
                        echo_cell('th8', 'Normal', 'Kouma', '紅');
                        echo_cell('th8', 'Normal', 'Yumei', '冥');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th8', 'Normal', 'Reimu', '霊');
                        echo_cell('th8', 'Normal', 'Marisa', '魔');
                        echo_cell('th8', 'Normal', 'Sakuya', '咲');
                        echo_cell('th8', 'Normal', 'Youmu', '妖');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th8', 'Normal', 'Yukari', '紫');
                        echo_cell('th8', 'Normal', 'Alice', 'ア');
                        echo_cell('th8', 'Normal', 'Remilia', 'レ');
                        echo_cell('th8', 'Normal', 'Yuyuko', '幽');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="3">H</td>';
                        echo_cell('th8', 'Hard', 'Kekkai', '結');
                        echo_cell('th8', 'Hard', 'Eishou', '詠');
                        echo_cell('th8', 'Hard', 'Kouma', '紅');
                        echo_cell('th8', 'Hard', 'Yumei', '冥');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th8', 'Hard', 'Reimu', '霊');
                        echo_cell('th8', 'Hard', 'Marisa', '魔');
                        echo_cell('th8', 'Hard', 'Sakuya', '咲');
                        echo_cell('th8', 'Hard', 'Youmu', '妖');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th8', 'Hard', 'Yukari', '紫');
                        echo_cell('th8', 'Hard', 'Alice', 'ア');
                        echo_cell('th8', 'Hard', 'Remilia', 'レ');
                        echo_cell('th8', 'Hard', 'Yuyuko', '幽');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="3">L</td>';
                        echo_cell('th8', 'Lunatic', 'Kekkai', '結');
                        echo_cell('th8', 'Lunatic', 'Eishou', '詠');
                        echo_cell('th8', 'Lunatic', 'Kouma', '紅');
                        echo_cell('th8', 'Lunatic', 'Yumei', '冥');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th8', 'Lunatic', 'Reimu', '霊');
                        echo_cell('th8', 'Lunatic', 'Marisa', '魔');
                        echo_cell('th8', 'Lunatic', 'Sakuya', '咲');
                        echo_cell('th8', 'Lunatic', 'Youmu', '妖');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th8', 'Lunatic', 'Yukari', '紫');
                        echo_cell('th8', 'Lunatic', 'Alice', 'ア');
                        echo_cell('th8', 'Lunatic', 'Remilia', 'レ');
                        echo_cell('th8', 'Lunatic', 'Yuyuko', '幽');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="3">X</td>';
                        echo_cell('th8', 'Extra', 'Kekkai', '結');
                        echo_cell('th8', 'Extra', 'Eishou', '詠');
                        echo_cell('th8', 'Extra', 'Kouma', '紅');
                        echo_cell('th8', 'Extra', 'Yumei', '冥');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th8', 'Extra', 'Reimu', '霊');
                        echo_cell('th8', 'Extra', 'Marisa', '魔');
                        echo_cell('th8', 'Extra', 'Sakuya', '咲');
                        echo_cell('th8', 'Extra', 'Youmu', '妖');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th8', 'Extra', 'Yukari', '紫');
                        echo_cell('th8', 'Extra', 'Alice', 'ア');
                        echo_cell('th8', 'Extra', 'Remilia', 'レ');
                        echo_cell('th8', 'Extra', 'Yuyuko', '幽');
                    echo '</tr>';
                echo '</table>';
            echo '</td>';
// TH9
            echo '<td>';
                echo '<table class="ftable th9">';
                echo '</table>';
            echo '</td>';
// TH10
            echo '<td>';
                echo '<table class="ftable th10">';
                    echo '<tr>';
                        echo '<td rowspan="2">E</td>';
                        echo_cell('th10', 'Easy', 'ReimuA', '霊A');
                        echo_cell('th10', 'Easy', 'ReimuB', '霊B');
                        echo_cell('th10', 'Easy', 'ReimuC', '霊C');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th10', 'Easy', 'MarisaA', '魔A');
                        echo_cell('th10', 'Easy', 'MarisaB', '魔B');
                        echo_cell('th10', 'Easy', 'MarisaC', '魔C');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">N</td>';
                        echo_cell('th10', 'Normal', 'ReimuA', '霊A');
                        echo_cell('th10', 'Normal', 'ReimuB', '霊B');
                        echo_cell('th10', 'Normal', 'ReimuC', '霊C');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th10', 'Normal', 'MarisaA', '魔A');
                        echo_cell('th10', 'Normal', 'MarisaB', '魔B');
                        echo_cell('th10', 'Normal', 'MarisaC', '魔C');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">H</td>';
                        echo_cell('th10', 'Hard', 'ReimuA', '霊A');
                        echo_cell('th10', 'Hard', 'ReimuB', '霊B');
                        echo_cell('th10', 'Hard', 'ReimuC', '霊C');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th10', 'Hard', 'MarisaA', '魔A');
                        echo_cell('th10', 'Hard', 'MarisaB', '魔B');
                        echo_cell('th10', 'Hard', 'MarisaC', '魔C');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">L</td>';
                        echo_cell('th10', 'Lunatic', 'ReimuA', '霊A');
                        echo_cell('th10', 'Lunatic', 'ReimuB', '霊B');
                        echo_cell('th10', 'Lunatic', 'ReimuC', '霊C');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th10', 'Lunatic', 'MarisaA', '魔A');
                        echo_cell('th10', 'Lunatic', 'MarisaB', '魔B');
                        echo_cell('th10', 'Lunatic', 'MarisaC', '魔C');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">X</td>';
                        echo_cell('th10', 'Extra', 'ReimuA', '霊A');
                        echo_cell('th10', 'Extra', 'ReimuB', '霊B');
                        echo_cell('th10', 'Extra', 'ReimuC', '霊C');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th10', 'Extra', 'MarisaA', '魔A');
                        echo_cell('th10', 'Extra', 'MarisaB', '魔B');
                        echo_cell('th10', 'Extra', 'MarisaC', '魔C');
                    echo '</tr>';
                echo '</table>';
            echo '</td>';
// TH11
            echo '<td>';
                echo '<table class="ftable th11">';
                    echo '<tr>';
                        echo '<td rowspan="2">E</td>';
                        echo_cell('th11', 'Easy', 'ReimuA', '霊A');
                        echo_cell('th11', 'Easy', 'ReimuB', '霊B');
                        echo_cell('th11', 'Easy', 'ReimuC', '霊C');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th11', 'Easy', 'MarisaA', '魔A');
                        echo_cell('th11', 'Easy', 'MarisaB', '魔B');
                        echo_cell('th11', 'Easy', 'MarisaC', '魔C');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">N</td>';
                        echo_cell('th11', 'Normal', 'ReimuA', '霊A');
                        echo_cell('th11', 'Normal', 'ReimuB', '霊B');
                        echo_cell('th11', 'Normal', 'ReimuC', '霊C');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th11', 'Normal', 'MarisaA', '魔A');
                        echo_cell('th11', 'Normal', 'MarisaB', '魔B');
                        echo_cell('th11', 'Normal', 'MarisaC', '魔C');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">H</td>';
                        echo_cell('th11', 'Hard', 'ReimuA', '霊A');
                        echo_cell('th11', 'Hard', 'ReimuB', '霊B');
                        echo_cell('th11', 'Hard', 'ReimuC', '霊C');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th11', 'Hard', 'MarisaA', '魔A');
                        echo_cell('th11', 'Hard', 'MarisaB', '魔B');
                        echo_cell('th11', 'Hard', 'MarisaC', '魔C');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">L</td>';
                        echo_cell('th11', 'Lunatic', 'ReimuA', '霊A');
                        echo_cell('th11', 'Lunatic', 'ReimuB', '霊B');
                        echo_cell('th11', 'Lunatic', 'ReimuC', '霊C');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th11', 'Lunatic', 'MarisaA', '魔A');
                        echo_cell('th11', 'Lunatic', 'MarisaB', '魔B');
                        echo_cell('th11', 'Lunatic', 'MarisaC', '魔C');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">X</td>';
                        echo_cell('th11', 'Extra', 'ReimuA', '霊A');
                        echo_cell('th11', 'Extra', 'ReimuB', '霊B');
                        echo_cell('th11', 'Extra', 'ReimuC', '霊C');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th11', 'Extra', 'MarisaA', '魔A');
                        echo_cell('th11', 'Extra', 'MarisaB', '魔B');
                        echo_cell('th11', 'Extra', 'MarisaC', '魔C');
                    echo '</tr>';
                echo '</table>';
            echo '</td>';
// TH12
            echo '<td>';
                echo '<table class="ftable th12">';
                    echo '<tr>';
                        echo '<td rowspan="2">E</td>';
                        echo_cell('th12', 'Easy', 'ReimuA', '霊A');
                        echo_cell('th12', 'Easy', 'MarisaA', '魔A');
                        echo_cell('th12', 'Easy', 'SanaeA', '早A');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th12', 'Easy', 'ReimuB', '霊B');
                        echo_cell('th12', 'Easy', 'MarisaB', '魔B');
                        echo_cell('th12', 'Easy', 'SanaeB', '早B');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">N</td>';
                        echo_cell('th12', 'Normal', 'ReimuA', '霊A');
                        echo_cell('th12', 'Normal', 'MarisaA', '魔A');
                        echo_cell('th12', 'Normal', 'SanaeA', '早A');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th12', 'Normal', 'ReimuB', '霊B');
                        echo_cell('th12', 'Normal', 'MarisaB', '魔B');
                        echo_cell('th12', 'Normal', 'SanaeB', '早B');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">H</td>';
                        echo_cell('th12', 'Hard', 'ReimuA', '霊A');
                        echo_cell('th12', 'Hard', 'MarisaA', '魔A');
                        echo_cell('th12', 'Hard', 'SanaeA', '早A');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th12', 'Hard', 'ReimuB', '霊B');
                        echo_cell('th12', 'Hard', 'MarisaB', '魔B');
                        echo_cell('th12', 'Hard', 'SanaeB', '早B');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">L</td>';
                        echo_cell('th12', 'Lunatic', 'ReimuA', '霊A');
                        echo_cell('th12', 'Lunatic', 'MarisaA', '魔A');
                        echo_cell('th12', 'Lunatic', 'SanaeA', '早A');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th12', 'Lunatic', 'ReimuB', '霊B');
                        echo_cell('th12', 'Lunatic', 'MarisaB', '魔B');
                        echo_cell('th12', 'Lunatic', 'SanaeB', '早B');
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td rowspan="2">X</td>';
                        echo_cell('th12', 'Extra', 'ReimuA', '霊A');
                        echo_cell('th12', 'Extra', 'MarisaA', '魔A');
                        echo_cell('th12', 'Extra', 'SanaeA', '早A');
                    echo '</tr>';
                    echo '<tr>';
                        echo_cell('th12', 'Extra', 'ReimuB', '霊B');
                        echo_cell('th12', 'Extra', 'MarisaB', '魔B');
                        echo_cell('th12', 'Extra', 'SanaeB', '早B');
                    echo '</tr>';
                echo '</table>';
            echo '</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>神霊廟</td>';
            echo '<td>輝針城</td>';
            echo '<td>紺珠伝</td>';
            echo '<td>天空璋</td>';
            echo '<td>鬼形獣</td>';
            echo '<td>虹龍洞</td>';
            echo '<td></td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>';
// TH13
            echo '</td>';
            echo '<td>';
// TH14
            echo '</td>';
            echo '<td>';
// TH15
            echo '</td>';
            echo '<td>';
// TH16
            echo '</td>';
            echo '<td>';
// TH17
            echo '</td>';
            echo '<td>';
// TH18
            echo '</td>';
            echo '<td>';
                echo '<table class="ftable color">';
                    echo '<tr><td class="nmnbnr">NMNBNR</td></tr>';
                    echo '<tr><td class="nmnb">NMNB</td></tr>';
                    echo '<tr><td class="nm">NM</td></tr>';
                    echo '<tr><td class="nbnr">NBNR</td></tr>';
                    echo '<tr><td class="nb">NB</td></tr>';
                    echo '<tr><td class="c">ALL</td></tr>';
                    echo '<tr><td>not-cleared</td></tr>';
                echo '</table>';
            echo '</td>';
        echo '</tr>';
    echo '</table>';
}

if ($shown_count !== $replay_count) {
    echo '<script> alert("リプレイの数と表示された情報の数が合いません。"); </script>';
}

?>

    <center>

</body>
</html>
