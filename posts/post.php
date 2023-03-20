<?php
  require("./_indecies.php");
  $id = isset($_GET['id']) ? $_GET['id'] : '';
  $title = 'Invalid Page';
  $exists = false;
  $prev_id = '';
  $next_id = '';
  if (!isset($indecies[$id]) || !file_exists('./' . $id)) {
    return;
  }
  foreach ($indecies as $key => $data) {
    if ($exists) {
      $prev_id = $key;
      break;
    }
    if ($key === $id) {
      $exists = true;
      $title = $data['title'];
      continue;
    }
    $next_id = $key;
  }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/head.html"); ?>
  <title><?php echo $title; ?></title>
  <style>
    div#tombstone-wrapper {
        margin-top: 2em;
        margin-bottom: 1em;
    }
    div#tombstone {
        background-color: black;
        margin-left: auto;
        margin-right: 1em;
        min-width: 1em;
        max-width: 1em;
        min-height: 1em;
        max-height: 1em;
    }
    div#postfooter {
        display: flex;
        margin-top: 1em;
    }
    div#postfooter a {
        font-weight: bold;
        text-decoration: none;
    }
    div#postfooter-next {
        margin-right: auto;
    }
    div#postfooter-prev {
        margin-left: auto;
    }
  </style>
</head>

<body>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.html"); ?>

  <div id="content-wrapper">
    <div id="content">
      <h1><?php echo $title; ?></h1>
      <?php if ($exists) echo_posttags($indecies[$id]['tag'], $indecies[$id]['date']); ?>

      <hr>

      <div><?php if ($exists) readfile('./' . $id); ?></div>
      <div id="tombstone-wrapper"><div id="tombstone"></div></div>

      <hr>

      <div id="postfooter">
        <div id="postfooter-next">
          <?php
            if ($next_id != '') {
              echo
                'Next Article',
                '<br>',
                '<a href="./post.php?id=', $next_id, '">', $indecies[$next_id]['title'], '</a>';
            }
          ?>
        </div>
        <div id="postfooter-prev">
          <?php
            if ($prev_id != '') {
              echo
                'Prev Article',
                '<br>',
                '<a href="./post.php?id=', $prev_id, '">', $indecies[$prev_id]['title'], '</a>';
            }
          ?>
        </div>
      </div>

    </div>
  </div>
  
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.html"); ?>
</body>

</html>
