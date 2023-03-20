#!/bin/bash
function get_bin() {
  grep -xq $2 .binary
  if [ $? -ne 0 ] || [ ! -e $1 ]; then
    if [ -e $1 ]; then
      rm $1
    fi
    wget -O $1 https://skdassoc.com/$2
    if [ $? = 0 ]; then
      echo $2 >> .binary_tmp
    fi
  else
    echo $2 >> .binary_tmp
  fi
}
get_bin favicon.ico favicon.ico
get_bin img/catch-image.png img/catch-image.png
get_bin img/vimstart-img01.png img/vimstart-img01.png
get_bin img/vimstart-img02.png img/vimstart-img02.png
get_bin img/vimstart-img03.png img/vimstart-img03.png
get_bin img/windows-to-ubuntu-img01.png img/windows-to-ubuntu-img01.png
get_bin img/gensou_no_yukue/set.png img/gensou_no_yukue/set.png
get_bin img/gensou_no_yukue/sister.png img/gensou_no_yukue/sister.png
get_bin img/gensou_no_yukue/marisa.png img/gensou_no_yukue/marisa.png
get_bin img/gensou_no_yukue/reimu.png img/gensou_no_yukue/reimu.png
get_bin img/gensou_no_yukue/mima.png img/gensou_no_yukue/mima.png
mv .binary_tmp .binary
