<?php
/*
Plugin Name: スクレイピング・プラグイン
Description: スクレイピングを行います。
Author: t-hiro
*/

//管理画面にボタン設定 
require('admin-button.php');
//チェック
require('no_hit.php');
// DB接続
require("db-connect.php");
//スクレイピング関数
require('scraping.php');
//ショートコード読み込み
require('shortcode.php');

// 自動実行用関数
add_action('my_auto_function_cron', 'scraping');
// cron登録処理
if (!wp_next_scheduled('my_auto_function_cron')) {
  date_default_timezone_set('Asia/Tokyo');  // タイムゾーンの設定
  wp_schedule_event(strtotime('2022-01-06 21:00:00'), 'weekly', 'my_auto_function_cron');
}
