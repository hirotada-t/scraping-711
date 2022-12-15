<?php
if (!defined('ABSPATH')) exit;

$i = 0;
foreach ($Data as $info) {
  $sql = "SELECT * FROM products WHERE name='" . $info['name'] . "'";
  $results = executeQuery($sql);
  $result = $results->fetch_assoc(); //連想配列でデータを取り出し
  if ($result != '') { //登録済みかどうか判定
    $sql = "UPDATE products SET ";
    $sql .= "url='"    . $info['url']    . "',";
    $sql .= "img_src='"    . $info['img']    . "',";
    $sql .= "price='"  . $info['price']  . "',";
    $sql .= "area='"   . $info['area']   . "',";
    $sql .= "allergy='" . $info['allergy'] . "',";
    // $sql .= "cal='"    . $info['cal']    . "',";
    $sql .= "p='"      . $info['p']      . "',";
    $sql .= "f='"      . $info['f']      . "',";
    $sql .= "c='"      . $info['c']      . "',";
    // $sql .= "s='"      . $info['s']      . "',";
    $sql .= "df='"     . $info['df']     . "',";
    $sql .= "n='"      . $info['n']      . "' ";
    $sql .= "WHERE name='" . $info['name'] . "'";
    $result = executeQuery($sql);
  } else {
    $sql = "INSERT INTO products ";
    $sql .= "(name,url,img_src,price,allergy,area,p,f,c,df,n) VALUES (";
    $sql .= "'" . $info['name'] . "',";
    $sql .= "'" . $info['url']  . "',";
    $sql .= "'" . $info['img']  . "',";
    $sql .= "'" . $info['price'] . "',";
    $sql .= "'" . $info['area'] . "',";
    $sql .= "'" . $info['allergy'] . "',";
    // $sql .= "'" . $info['cal'] . "',";
    $sql .= "'" . $info['p'] . "',";
    $sql .= "'" . $info['f'] . "',";
    $sql .= "'" . $info['c'] . "',";
    // $sql .= "'" . $info['s'] . "',";
    $sql .= "'" . $info['df'] . "',";
    $sql .= "'" . $info['n'] . "')";
    $result = executeQuery($sql);
  }
  $i++;
}
echo $i;
