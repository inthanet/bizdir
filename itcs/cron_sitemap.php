<?php

$test  = false; //Only first 40 images
$debug = false;  //error_reporting(E_ALL & ~E_NOTICE);

$country_sitemaps = array();
if(file_exists('/home/bizdir/public_html/itcs/sitemap.json')){
  $json_data = file_get_contents('/home/bizdir/public_html/itcs/sitemap.json'); 
  $country_sitemaps = json_decode($json_data);
  print_r($country_sitemaps);
} else {
  die('oops');
}

die('done');

$updates = 0;
$tagupdates = 0;
date_default_timezone_set('Asia/Hong_Kong');


$now = date('Y-m-d H:i:s',time());

require_once('dbconnect.php');






//**********************************  XML BLACK  **********************************
$xmlHeader = '<?xml version="1.0" encoding="utf-8"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

$xmlFooter = "</urlset>\n";



if($debug) echo "<hr><hr><hr>CRON GENERATE PRODUCT SITEMAP<br>";

$updatesSQL = "SELECT
  COUNT(*) AS `UPD`
FROM
  `products`";

$updates = $conn->query($updatesSQL);
if($updates->num_rows > 0) {
  $count = $updates -> fetch_array();
  echo "<br>UPDATES: ". $count['UPD'];

} else {
  $_txt = "\n"."No Updates, new product sitemap will not be generated";
  fwrite($log, $_txt);
  $_txt = "\n"."END cron_product_sitemap.php : ".date("F j, Y, g:i a");
  fwrite($log, $_txt);
  fclose($log);
  die();
}

if(!$count > 0) {
  $_txt = "\n"."No Updates, new product sitemap will not be generated";
  fwrite($log, $_txt);
  $_txt = "\n"."END cron_product_sitemap.php : ".date("F j, Y, g:i a");
  fwrite($log, $_txt);
  fclose($log);
  die();
}

//url: https://itcs-asia.vip/item/307/thrive-optimize
//url: https://itcs-asia.vip/item/id/slug

$andWhere = '';
if($test) $andWhere = ' AND `products`.`id` < 40';

$productSql = "SELECT
  `products`.`id`,
  `products`.`slug`,
  `products`.`last_update`
FROM
  `products`
WHERE
  `products`.`active` = 1 AND `products`.`soon` = 0 ".$andWhere;

if($debug) echo '<hr>'.$productSql.'<hr>';

$products = $conn->query($productSql);


if($debug) echo "ROWS: ".$products->num_rows.'<hr>';


if($products->num_rows > 0) {
    $siteMapEntries = $products->num_rows;

    $sitemapFile = fopen($_SERVER['DOCUMENT_ROOT']."/public/products.xml", "w");
    $_data = $xmlHeader. "\n";
    fwrite($sitemapFile, $_data);

    while($product = $products -> fetch_array() ) {

$xmlBlock =
"<url>
    <loc>https://".$_SERVER['HTTP_HOST']."/item/".$product['id']."/".$product['slug']."</loc>
</url>\n";

        fwrite($sitemapFile, $xmlBlock);
    }

    fwrite($sitemapFile, $xmlFooter);

} else {
    if($debug) echo 'NO DATA';
}


$conn->close();

$_txt = "\n"."END cron_product_sitemap.php : ".date("F j, Y, g:i a")." | ROWS: ".$siteMapEntries;
fwrite($log, $_txt);
fclose($log)
?>