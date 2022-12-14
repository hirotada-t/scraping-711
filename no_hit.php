<?php
function url_check(){
  $sql = "SELECT * FROM products";
  $results = executeQuery($sql);
  $i=0;
  while($data=$results->fetch_assoc()){
    $url="https://www.sej.co.jp".$data['url'];
    $check = @file_get_contents($url);
    if(!$check){
      $sql = "DELETE FROM products WHERE url='".$data['url']."'";
      executeQuery($sql);
      $i++;
    }
  }
  echo $i."件のデータを削除しました";
}
