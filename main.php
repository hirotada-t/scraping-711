<?php
/**
 * Plugin Name: スクレイピング・プラグイン
 * Plugin URI: プラグインの説明ページなどのURL
 * Description: セブンイレブンの商品情報を取得してDBに保存します。また必要に応じてソートして表示することができます。
 * Version: 1.0.0
 * Author: hirotada
 * Author URI: 制作者のサイトURL
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: 翻訳用のテキストドメイン
 */
if ( ! defined( 'ABSPATH' ) ) exit;

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
