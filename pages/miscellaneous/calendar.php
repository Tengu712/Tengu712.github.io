<!DOCTYPE html>
<html lang="ja">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes">
<title>Calendar</title>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: solid 1px black;
        padding: 0.5em;
    }
    th:first-child, td:first-child {
        width: 0;
        white-space: nowrap;
    }
</style>

<p>予定表</p>

<p>ここに何も書いていないからといって用事がないとは限らない。</p>

<?php

$json = json_decode(file_get_contents('./calendar.json'), true);

echo '<table><thead><tr><th>date</th><th>content</th></tr>';

$dow = array('月', '火', '水', '木', '金', '土', '日');
$cnt = 5;

for ($year = 23; $year <= 24; $year += 1) {
    for ($month = 1; $month <= 12; $month += 1) {
        if ($year === 23 && $month < 4) continue;
        for ($day = 1; $day <= 31; $day += 1) {
            echo '<tr><td>20',
                $year,
                '/',
                $month,
                '/',
                $day,
                ' (',
                $dow[$cnt % 7],
                ')',
                '</td><td>';
            if (isset($json[$year][$month][$day])) {
                foreach ($json[$year][$month][$day] as $content) {
                    echo $content, '<br>';
                }
            }
            echo '</td></tr>';
            $cnt += 1;
        }
    }
}

?>
