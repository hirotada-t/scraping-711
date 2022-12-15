<?php
if (!defined('ABSPATH')) exit;

function executeQuery($sql)
{
  $dbh = new mysqli('mysql2306.xserver.jp', 'ucchaso1210_1ki1', 'pt4rivc624', 'ucchaso1210_711data');
  $result = $dbh->query($sql);
  if ($result) {
    return $result;
  } else {
    echo 'sqlエラーです<br>';
    echo $dbh->error;
  }
}
