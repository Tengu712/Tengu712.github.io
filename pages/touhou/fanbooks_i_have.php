<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes">
  <title>東方同人誌表</title>
  <style>
    body {
      background-color: black;
      color: white;
      margin: 1em;
    }

    a {
      color: red;
    }

    a:visited {
      color: red;
    }

    p {
      text-align: right;
    }

    table {
      max-width: 100%;
      border-collapse: collapse;
    }

    td,
    th {
      border-bottom: solid 1px white;
      border-top: solid 1px white;
      padding: 0.25em;
    }

    td.newcircle,
    th {
      border-top: solid 4px white;
    }

    @media screen and (max-width: 1000px) {

      td.hidable,
      th.hidable {
        display: none;
      }
    }
  </style>
</head>

<body>
  <h1>紙媒体で所有する・かつ既読の東方同人誌</h1>

  <p>2022/8/9更新</p>
  <center>
    <table>
      <tr>
        <th>サークル名</th>
        <th class="hidable">作者名</th>
        <th>題名</th>
        <th class="hidable">発行日</th>
      </tr>
      <?php
      $tmp_circle = '';
      $tmp_person = '';
      foreach (file('./fanbooks_i_have.dat') as $line) {
        $contents = explode('|', $line);
        $newcircle = $contents[0] != $tmp_circle ? 'newcircle' : '';
        echo '<tr>';
        echo '<td class="', $newcircle, '">';
        if ($contents[0] != $tmp_circle) {
          echo $contents[0];
        }
        echo '</td>';
        echo '<td class="hidable ', $newcircle, '">';
        if ($contents[1] != $tmp_person) {
          echo $contents[1];
        }
        echo '</td>';
        echo '<td class="', $newcircle, '">';
        echo $contents[2];
        echo '</td>';
        echo '<td class="hidable ', $newcircle, '">';
        echo $contents[3];
        echo '</td>';
        echo '</tr>';
        $tmp_circle = $contents[0];
        $tmp_person = $contents[1];
      }
      ?>
    </table>

    <br>

    <a href="/pages/index.php">戻る</a>
  </center>

</body>

</html>