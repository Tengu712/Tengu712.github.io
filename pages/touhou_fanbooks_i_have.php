<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <title>東方同人誌表</title>
</head>

<body>
  <h1>紙媒体で所有する・かつ既読の東方同人誌</h1>
  2022/8/9更新

<?php
echo "<table>";
  echo "<tr>";
    echo "<th>サークル名</th>";
    echo "<th>作者名</th>";
    echo "<th>題名</th>";
    echo "<th>発行日</th>";
    echo "<th>備考</th>";
  echo "</tr>";
$tmp_circle = "";
$tmp_person = "";
foreach(file("pages/permanents/touhou_fanbooks_i_have.dat") as $line) {
    $contents = explode("|", $line);
    echo "<tr>";
      echo "<td>";
      if ($contents[0] != $tmp_circle) {
        echo $contents[0];
      }
      echo "</td>";
      echo "<td>";
      if ($contents[1] != $tmp_person) {
        echo $contents[1];
      }
      echo "</td>";
      echo "<td>";
        echo $contents[2];
      echo "</td>";
      echo "<td>";
        echo $contents[3];
      echo "</td>";
      echo "<td>";
        echo $contents[4];
      echo "</td>";
    echo "</tr>";
    $tmp_circle = $contents[0];
    $tmp_person = $contents[1];
}
echo "</table>";
?>

</body>

</html>
