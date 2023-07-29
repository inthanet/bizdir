<?php

$test = true; //Only first 10 images
$debug = true; //error_reporting(E_ALL & ~E_NOTICE);

$google_sitmap_ping = false;
$bing_sitmap_ping = false;

$now = date('Y-m-d H:i:s', time());
$dayOffWeek = date('N', date(time())); //1 = Monday,... 5 = Friday,... 0 = Sunday

$country_sitemaps = array();
if (file_exists('/home/bizdir/public_html/itcs/sitemap.json')) {
  $json_data = file_get_contents('/home/bizdir/public_html/itcs/sitemap.json');
  $country_sitemaps = json_decode($json_data, true);
  
} else {
  die('oops');
}



$updates = 0;
$tagupdates = 0;
date_default_timezone_set('Asia/Hong_Kong');

$now = date('Y-m-d\TH:i:sP',time());


require_once('dbconnect.php');




//**********************************  XML BLACK  **********************************
$xmlHeader = '
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
       xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
       xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
       http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

$xmlFooter = "</urlset>";



//if($debug) echo "<hr><hr><hr>CRON GENERATE PRODUCT SITEMAP<br>";



$limit = '';
if ($test)
  $limit = ' LIMIT 10';

for ($i = 0; $i < count($country_sitemaps); $i++) {

  $prefix = $country_sitemaps[$i]['prefix'];

  // Set the appropriate country prefix based on the subdomain
  switch ($prefix) {
    case 'ww':
        $COUNTRY_PREFIX = $prefix.'_'; 
        $COUNTRY_XML_FILE = ''; 
        $COUNTRY_SUBDOMAIN = '';
        $COUNTRY_TIMEZONE = 'America/New_York';
        break;    
    case 'en':
        $COUNTRY_PREFIX = $prefix.'_';
        $COUNTRY_XML_FILE = $prefix.'-';
        $COUNTRY_SUBDOMAIN = $prefix.'.'; 
        $COUNTRY_TIMEZONE = 'Europe/London';
        break;
    case 'de':
        $COUNTRY_PREFIX = $prefix.'_';
        $COUNTRY_XML_FILE = $prefix.'-';
        $COUNTRY_SUBDOMAIN = $prefix.'.';      
        $COUNTRY_TIMEZONE = 'Europe/Berlin';   
        break;     
    case 'fr':
        $COUNTRY_PREFIX = $prefix.'_';
        $COUNTRY_XML_FILE = $prefix.'-';
        $COUNTRY_SUBDOMAIN = $prefix.'.'; 
        $COUNTRY_TIMEZONE = 'Europe/Paris'; 
        break;                     
    default:
        //main prefix
        $COUNTRY_PREFIX =  $prefix.'_'; 
        $COUNTRY_XML_FILE = ''; 
        $COUNTRY_SUBDOMAIN = '';
        $COUNTRY_TIMEZONE = 'Europe/London';
 
  }

  $categories_list = $country_sitemaps[$i]['categories'];
  $categories = explode(',',$categories_list);
  if($debug) echo $categories_list.'<br>';

  $category_slug_list = $country_sitemaps[$i]['category_url_slugs'];
  $category_slug = explode(',',$category_slug_list);
  if($debug) echo $category_slug_list.'<br>';

  $priority_list = $country_sitemaps[$i]['sitemap_priority'];
  $xml_priority = explode(',',$priority_list);
  if($debug) echo $priority_list.'<br>';
  
  $status_list = $country_sitemaps[$i]['db_status_column'];
  $status = explode(',',$status_list);
  if($debug) echo $status_list.'<br>';

  $slug_list = $country_sitemaps[$i]['db_slug_column'];
  $slug = explode(',',$slug_list);
  if($debug) echo $status_list.'<br>';
  
  //if($debug) print_r($categories);

  $cnt_categories = count($categories);

  for ($c = 0; $c < count($categories); $c++) {


    $Sql = "SELECT * FROM " . $COUNTRY_PREFIX. $categories[$c] ."
                     WHERE ".$status[$c]." = 'Active' " . $limit;

    if ($debug) echo '<hr>' . $Sql . '<hr>';

    $result = $conn->query($Sql);


    if ($debug)
      echo "ROWS: " . $result->num_rows . '<hr>';
 

    if ($result->num_rows > 0) {
      $siteMapEntries = $result->num_rows;

      date_default_timezone_set($COUNTRY_TIMEZONE);
      $now = date('Y-m-d\TH:i:sP',time());

      $xml_file = "/home/bizdir/public_html/sitemap-" . $COUNTRY_XML_FILE . $categories[$c] . ".xml";
      $siteMapFile = fopen($xml_file , "w");  //XML FILE: /home/bizdir/public_html/sitemap-listings.xml      

      $siteMapUrl = 'https://' . $COUNTRY_SUBDOMAIN . 'bizdir.online/sitemap-' . $COUNTRY_XML_FILE . $categories[$c] . '.xml';
      if($debug) echo 'TIMEZONE: '.date_default_timezone_get().'<br>';
      if($debug) echo 'XML FILE: '. $xml_file.'<br>';
      if($debug) echo 'Sitemap File URL: '.$siteMapUrl.'<br><br>';

      $_data = $xmlHeader . "\n";
      fwrite($siteMapFile, $_data);


      while ($row = $result->fetch_array()) {
        $url = 'https://' . $COUNTRY_SUBDOMAIN . 'bizdir.online/'.$category_slug[$c].'/' . Get_Slug($row[$slug[$c]]);
        if($debug) echo $url.'<br>';

        $xmlBlock  = " <url>\n";
        $xmlBlock .= "   <loc>". $url ."</loc>\n";
        $xmlBlock .= "   <lastmod>". $now ."</lastmod>\n";
        $xmlBlock .= "   <priority>". $xml_priority[$c] ."</priority>\n";
        $xmlBlock .= " </url>\n";

        fwrite($siteMapFile, $xmlBlock);
      }

      fwrite($siteMapFile, $xmlFooter);

      fclose($siteMapFile);

      if($google_sitmap_ping){
        //result_google = urlPing('http://www.google.com/webmasters/sitemaps/ping?sitemap='.$siteMapUrl);
        $sitemapUrl = $siteMapUrl;
        pingGoogle($sitemapUrl);        
      }

      if($bing_sitmap_ping){
        // $result_bing = urlPing('http://www.bing.com/webmaster/ping.aspx?siteMap='.$siteMapUrl);
        $sitemapUrl = $siteMapUrl;
        pingBing($sitemapUrl);       
      }


    } else {
      if ($debug) echo 'NO DATA';
    }
  }
}

$conn->close();
function Get_Slug($slug)
{
      $replacements = array(
        ' ' => '-',
        '.' => '',
        '(' => '',
        ')' => '',
        '--' => '-',
        'ü' => 'ue', 
        'ö' => 'oe',
        'ä' => 'ae',
        'ß' => 'ss'
      );
  
      $slug = str_replace(array_keys($replacements), array_values($replacements), strtolower($slug));
      return preg_replace("/[^a-z0-9\-]/", '', $slug);
  
}

function pingGoogle($sitemapUrl) {
  $googlePingUrl = 'http://www.google.com/ping?sitemap=' . urlencode($sitemapUrl);

  $curl = curl_init($googlePingUrl);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($curl);
  curl_close($curl);

  // Optionally, you can check the response for success or errors

}

function pingBing($sitemapUrl) {
  $bingPingUrl = 'http://www.bing.com/ping?sitemap=' . urlencode($sitemapUrl);

  $curl = curl_init($bingPingUrl);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($curl);
  curl_close($curl);

  // Optionally, you can check the response for success or errors
}

?>