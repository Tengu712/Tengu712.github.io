<?php

/* included in index.php */

// ================================================================================================================= //

$indecies = array(
  'enum-windows' => array(
    'title' => 'ウィンドウアプリケーションの列挙',
    'date' => '2023/2/14',
    'tag' => array('windowsapi'),
  ),
  'start-vim' => array(
    'title' => 'Vim今更入門',
    'date' => '2022/12/5',
    'tag' => array('vim'),
  ),
  'windows-to-ubuntu' => array(
    'title' => 'WindowsからUbuntuへ',
    'date' => '2022/11/22',
    'tag' => array('os', 'diary'),
  ),
  'start' => array(
    'title' => 'ブログ開設',
    'date' => '2022/11/21',
    'tag' => array('diary'),
  ),
);

// ================================================================================================================= //

function echo_posttags($_posttags, $_date) {
   echo '<div class="posttags">';
       foreach ($_posttags as $_posttag) {
           echo '<div class="posttag">';
               echo '<a href="./?tag=';
               echo $_posttag;
               echo '">#';
               echo $_posttag;
               echo '</a>';
           echo '</div>';
       }
       echo '<div class="postdate">';
           echo $_date;
       echo '</div>';
   echo '</div>';
}

$type = isset($_GET['type']) ? $_GET['type'] : '';
$tag = isset($_GET['tag']) ? $_GET['tag'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

// ================================================================================================================= //

if ($type === 'post') {
  echo '<script>(function remove_catch_image() { document.getElementById("content-wrapper").removeChild(document.getElementById("catch-image")); })(); </script>';
  if (!isset($indecies[$id]) || !file_exists('./posts/' . $id)) {
      echo 'invalid page';
      return;
  }

  // title
  echo '<h1>';
  echo $indecies[$id]['title'];
  echo '</h1>';
  // tags
  echo_posttags($indecies[$id]['tag'], $indecies[$id]['date']);
  // border
  echo '<hr>';

  //text
  echo '<div>';
  readfile('./posts/' . $id);
  echo '</div>';

  // tombstone
  echo '<div id="tombstone-wrapper"><div id="tombstone"></div></div>';
  // border
  echo '<hr>';

  // footer
  echo '<div id="postfooter">';
      $prev_id = '';
      $next_id = '';
      $flag = false;
      foreach ($indecies as $key => $tmp) {
        if ($flag) {
          $prev_id = $key;
          break;
        }
        if ($key === $id) {
          $flag = true;
          continue;
        }
        $next_id = $key;
      }
      if ($next_id != '') {
          echo '<div id="postfooter-next">';
              echo 'Next Article';
              echo '<br>';
              echo '<a href="./?type=post&id=';
                  echo $next_id;
                  echo '">';
                  echo $indecies[$next_id]['title'];
              echo '</a>';
          echo '</div>';
      }
      if ($prev_id != '') {
          echo '<div id="postfooter-prev">';
              echo 'Prev Article';
              echo '<br>';
              echo '<a href="./?type=post&id=';
                  echo $prev_id;
                  echo '">';
                  echo $indecies[$prev_id]['title'];
              echo '</a>';
          echo '</div>';
      }
  echo '</div>';
}

// ================================================================================================================= //

else {
  if ($tag != '') {
    echo '<div id="tagsearch-message">Searching for #';
    echo $tag;
    echo '</div>';
  }
  foreach ($indecies as $key => $index) {
    if ($tag != '' && !in_array($tag, $index['tag'])) {
      continue;
    }
    echo '<div class="postindex">';
      echo '<div class="posttitle">';
        echo '<a href="./?type=post&id=';
        echo $key;
        echo '">';
        echo $index['title'];
        echo '</a>';
      echo '</div>';
      echo_posttags($index['tag'], $index['date']);
    echo '</div>';
  }
}
