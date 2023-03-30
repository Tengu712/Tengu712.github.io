<?php

$indecies = array(
  'solink-speed' => array(
    'title' => '動的リンクライブラリの暗黙的/動的リンクの速度比較',
    'date' => '2023/3/30',
    'tag' => array('experiment'),
  ),
  'com-in-rust' => array(
    'title' => 'COMの構造とRust FFIで扱う手法',
    'date' => '2023/3/22',
    'tag' => array('windowsapi', 'rust'),
  ),
  'stdout-speed' => array(
    'title' => 'printf vs fwrite',
    'date' => '2023/3/20',
    'tag' => array('experiment'),
  ),
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
