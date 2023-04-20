<!DOCTYPE html>
<html lang="ja">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes">
<title>Calendar</title>
<style>
    @media screen and (max-width: 1000px) {
        body {
            font-size: 0.5em;
        }
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: solid 1px black;
        padding: 0.5em;
    }
    p {
        margin: 0px;
    }
    p.day {
        position: relative;
        color: gray;
    }
    td {
        text-align: left;
        vertical-align: top;
        height: 5em;
    }
    td.empty {
        background-color: #ccc;
    }
</style>

<p>予定表</p>

<p>ここに何も書いていないからといって用事がないとは限らない。</p>

<p>ページロード時、閲覧時の年月に対応する表にジャンプする。しないなら、なにかおかしい。</p>

<?php

    $json = json_decode(file_get_contents('./calendar.json'), true);

    $dow = array('日', '月', '火', '水', '木', '金', '土');
    $cnt = 6;

    for ($year = 23; $year <= 24; $year += 1) {
        for ($month = 1; $month <= 12; $month += 1) {
            if ($year === 23 && $month < 4) continue;
        echo '<h1>20', $year, '年', $month, '月</h1>';
            echo '<table id="', $year, '/', $month,'"><tr>';
            for ($i = 0; $i < 7; $i += 1) {
                echo '<th>', $dow[$i], '</th>';
            }
            echo '</tr><tr>';
        for ($i = 0; $i < $cnt % 7; $i += 1) {
                echo '<td class="empty"></td>';
        }
            for ($day = 1; $day <= 31; $day += 1) {
                if ($day > 30 && ($month === 4 || $month === 6 || $month === 9 || $month === 11)) break;
                if ($day > 28 && $month === 2 && ($year === 25 || $year === 26)) break;
                if ($day > 29 && $month === 2 && ($year === 24)) break;
                if ($cnt % 7 === 0) echo '</tr><tr>';
                echo '<td><p class="day">', $day, '</p>';
                echo '<p>';
                if (isset($json[$year][$month][$day])) {
                    foreach ($json[$year][$month][$day] as $content) {
                        echo $content, '<br>';
                    }
                }
                echo '</p></td>';
                $cnt += 1;
            }
            if ($cnt % 7 !== 0) {
            for ($i = $cnt % 7; $i < 7; $i += 1) {
                    echo '<td class="empty"></td>';
                }
            }
        echo '</tr></table>';
        }
    }

    echo '<script>(function (){location.href="#', date('y/n'), '";})();</script>';

?>
