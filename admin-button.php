<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action('admin_menu', 'scraping_btn');
function scraping_btn()
{
  add_menu_page('Test Button', 'スクレイピング', 'manage_options', 'scraping', 'scraping', 'dashicons-filter');
  add_menu_page('Check', 'URLチェック', 'manage_options', 'check', 'url_check', 'dashicons-list-view');
}