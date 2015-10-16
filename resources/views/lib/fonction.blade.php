<?php
  function getMatchChar($query,$content){
  	$match_pos = [];
    $word_query = str_split($query);
    $word_compare = str_split($content);
    var_dump($word_compare);
    var_dump($word_query);
    foreach ($word_query as $key => $value) {
        $exist = 0;
        if(!empty($done)){
            foreach ($done as $dkey => $dvalue) {
              if($dvalue==$value){
                $exist = 1;
              }
            }
        }
        if($exist==0){
          foreach ($word_compare as $ckey => $cvalue) {
              if($value == $cvalue){
                $match_pos[] = $ckey;
              }
          } 
        }
      $done[] = $value;
    }
    return $match_pos;
  }
?>

