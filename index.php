<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <title>天狗会議録</title>
  <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/atelier-dune-dark.css">
  <script type="text/javascript" src="./js/cssselector.js"></script>
</head>

<body>

  <div id="header">
    <div id="logo"><a href="./">天狗会議録</a></div>
    <div class="menu"><a href="./pages/pages.php">Pages</a></div>
    <div class="menu"><a href="./pages/about.html">About</a></div>
  </div>

  <div id="content-wrapper">
    <img id="catch-image" src="./img/catch-image.png" />
    <div id="content">
      <?php include('./posts/_post.php'); ?>
    </div>
  </div>

  <div id="footer"><p>2022-2023, Tengu712, Skydog Association</p></div>
</body>

</html>
