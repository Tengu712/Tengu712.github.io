<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/head.html"); ?>
  <title>天狗会議録</title>
  <style>
    img#catch-image {
      width: 100%;
    }
    div.postindex {
      margin: 2em 0;
    }
    div.postindex div.posttitle a {
      font-size: 1.5em;
      font-weight: bold;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.html"); ?>

  <div id="content-wrapper">
    <img id="catch-image" src="/img/catch-image.png" />
    <div id="content">
      <?php
        require("./_indecies.php");
        $tag = isset($_GET['tag']) ? $_GET['tag'] : '';
        if ($tag != '') {
          echo '<div id="tagsearch-message">Searching for #', $tag, '</div>';
        }
        foreach ($indecies as $key => $index) {
          if ($tag != '' && !in_array($tag, $index['tag'])) {
            continue;
          }
          echo '<div class="postindex">',
            '<div class="posttitle">',
              '<a href="./post.php?&id=',
              $key,
              '">',
              $index['title'],
              '</a>',
            '</div>';
            echo_posttags($index['tag'], $index['date']);
          echo '</div>';
        }     
      ?>
    </div>
  </div>
  
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.html"); ?>
</body>

</html>
