<?php

function countWords(){

$text = "Laravel attempts to take the pain out of development by easing common tasks 
used in the majority of web projects, such as authentication, routing, sessions, and caching.";

$words = str_word_count(mb_strtolower($text), 1); //для кирилиці додати третій параметр "АаБбВвГгДдЕеЁёЖжЗзИиіІїІЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя"
$frequency = array_count_values($words);
echo "Найбільш часто зустрічається: ";
foreach ($frequency as $key => $value) {
  if($value == max($frequency))

    echo $key . " ";
  }
}
