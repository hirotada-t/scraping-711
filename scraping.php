<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function scraping()
{
  require("phpQuery-onefile.php");
  $target = "https://www.sej.co.jp/products/a/cat/010010010000000/1/l100/";
  $doc = phpQuery::newDocumentFile($target);
  // ①$targetから商品名・URL・価格・地域を取得し配列として保存

  foreach ($doc["#areaWrapper1"]->find(".pbNestedWrapper:eq(2)")->find(".list_inner") as $entry) {
    // 名前
    $name = pq($entry)->find(".item_ttl")->text();
    // URL
    $url = pq($entry)->find(".item_ttl")->find('a')->attr('href');
    // 価格
    $price = pq($entry)->find(".item_price")->text();
    $price = substr($price, 0, 3);
    // 地域
    $area = pq($entry)->find(".item_region")->text();
    $area = str_replace('販売地域：', '', $area);

    // ②個別ページから情報を取得
    $doc = phpQuery::newDocumentFile("https://www.sej.co.jp" . $url);
    // 画像URL
    $img = $doc[".productWrap"]->find("ul")->find("li")->find("img")->attr('src');
    // アレルギー
    $allergy = $doc[".allergy"]->find("tr:eq(0)")->find("dd")->text();
    // 栄養成分
    $comp = $doc[".allergy"]->find("tr:eq(1)")->find("td")->text();
    // カロリー
    $cal = str_replace('熱量：', '', $comp);
    $cal = substr($cal, 0, 4);
    $cal = str_replace('k', '', $cal);
    $cal = str_replace('c', '', $cal);
    $cal = str_replace('a', '', $cal);
    // たんぱく質
    $comp = str_replace("熱量：" . $cal . "kcal、たんぱく質：", '', $comp);
    $p = substr($comp, 0, 4);
    $p = str_replace('g', '', $p);
    $p = str_replace('、', '', $p);
    // 脂質
    $comp = str_replace($p . "g、脂質：", '', $comp);
    $f = substr($comp, 0, 4);
    $f = str_replace('g', '', $f);
    $f = str_replace('、', '', $f);
    // 炭水化物
    $comp = str_replace($f . "g、炭水化物：", '', $comp);
    $c = substr($comp, 0, 5);
    $c = str_replace('g', '', $c);
    $c = str_replace('（', '', $c);
    // 糖質
    $comp = str_replace($c . "g（糖質：", '', $comp);
    $s = substr($comp, 0, 4);
    $s = str_replace('g', '', $s);
    $s = str_replace('、', '', $s);
    // 食物繊維
    $comp = str_replace($s . "g、食物繊維：", '', $comp);
    $df = substr($comp, 0, 4);
    $df = str_replace('g', '', $df);
    $df = str_replace('、', '', $df);
    // 食塩
    $comp = str_replace($df . "g）、食塩相当量：", '', $comp);
    $n = substr($comp, 0, 4);
    $n = str_replace('g', '', $n);
    $n = str_replace('、', '', $n);

    // 配列に格納
    $Data[] = [
      'name' => $name,
      'url' => $url,
      'img' => $img,
      'price' => $price,
      'area' => $area,
      'allergy' => $allergy,
      'comp' => $comp,
      // 'cal' => $cal,
      'p' => $p,
      'f' => $f,
      'c' => $c,
      // 's' => $s,
      'df' => $df,
      'n' => $n
    ];
  }

  require_once("db.php");
  $Data=[];
}
