<?php

$pass = rtrim(file_get_contents('./.keyword'), "\n");
if ($pass != $_POST['pass']) {
    $res['msg'] = 'password incorrect';
    echo json_encode($res);
    return;
}

$type = $_POST['type'];

if ($type == 'record') {
    // get json data
    $json = json_decode(file_get_contents('./calendar.json'), true);

    // split date
    $date_splited = explode('-', $_POST['date']);
    if (count($date_splited) < 3) {
        $res['msg'] = 'date must be yy-mm-dd';
        echo json_encode($res);
        return;
    }
    $year = $date_splited[0];
    $month = $date_splited[1];
    $day = $date_splited[2];

    // date validation
    if (!is_numeric($year) || !is_int(intval($year))) {
        $res['msg'] = 'invalid year: ' . $year;
        echo json_encode($res);
        return;
    } else {
        $year = (string)intval($year);
    }
    if (!is_numeric($month) || !is_int(intval($month)) || $month < 1 || $month > 12) {
        $res['msg'] = 'invalid month: ' . $year;
        echo json_encode($res);
        return;
    } else {
        $month = (string)intval($month);
    }
    if (!is_numeric($day) || !is_int(intval($day)) || $day < 1 || $day > 31) {
        $res['msg'] = 'invalid day: ' . $day;
        echo json_encode($res);
        return;
    } else {
        $day = (string)intval($day);
    }

    // add data
    if (!isset($json[$year][$month][$day])) $json[$year][$month][$day] = array();
    array_push($json[$year][$month][$day], $_POST['content']);

    // finish
    $encoded = json_encode($json);
    if ($encoded) file_put_contents('./calendar.json', $encoded);
}
else if ($type === 'remove') {
    $json = json_decode(file_get_contents('./calendar.json'), true);
    $date_splited = explode('-', $_POST['date']);
    if (count($date_splited) < 3) {
        $res['msg'] = 'date must be yy-mm-dd';
        echo json_encode($res);
        return;
    }
    $year = (string)((int)$date_splited[0]);
    $month = (string)((int)$date_splited[1]);
    $day = (string)((int)$date_splited[2]);
    if (!isset($json[$year][$month][$day])) {
        $res['msg'] = 'empty';
        echo json_encode($res);
        return;
    }
    $json[$year][$month][$day] = array();
    $encoded = json_encode($json);
    if ($encoded) file_put_contents('./calendar.json', $encoded);
}
else {
    $res['msg'] = 'invalid query type: ' . $type;
    echo json_encode($res);
    return;
}

$res['msg'] = 'succeeded';
echo json_encode($res);
