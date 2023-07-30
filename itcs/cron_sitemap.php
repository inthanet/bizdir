<?php
//GENERATE SITEMAP
//Author: ITCS-Asia, U.Inthanet, 2023-07-30 18:47:28

$test  = false; //! If `true` Database LIMIT 10
$debug = false; //error_reporting(E_ALL & ~E_NOTICE);

//ui SITEMAP, PING TO GOOGLE & BING 
$google_sitmap_ping = false;
$bing_sitmap_ping   = false;

$logBasePath = '/home/bizdir/public_html/logs';
$logFolder   = 'crons';
$logFileName = 'cron-generate-sitmap';
$_log_content_new = "";
$_log_content_old = "";

if($test){
  cronLog('GENERATE SITEMAP [Test, Limit 10]','open');
} else {
  cronLog('GENERATE SITEMAP','open');
}


//$now = date('Y-m-d H:i:s', time());
//$dayOffWeek = date('N', date(time())); //1 = Monday,... 5 = Friday,... 0 = Sunday

$country_sitemaps = array();
if (file_exists('/home/bizdir/public_html/itcs/sitemap.json')) {
  $json_data = file_get_contents('/home/bizdir/public_html/itcs/sitemap.json');
  $country_sitemaps = json_decode($json_data, true);
  
} else {

  cronLog('ERROR, File: `sitemap.json` not exists','close');
  die('oops');

}

$updates = 0;
$tagupdates = 0;

require_once('dbconnect.php');


//**********************************  XML BLACK  **********************************
$xmlHeader = '
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
       xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
       xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
       http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

$xmlFooter = "</urlset>";

$limit = '';
if ($test){
  $limit = ' LIMIT 10';

} 

for ($i = 0; $i < count($country_sitemaps); $i++) {

  //* Set the appropriate country prefix based on the subdomain
  $prefix = $country_sitemaps[$i]['prefix'];

  cronLog("\n\n".'PREFIX = `'.$prefix.'`'."\n");

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
  cronLog('--> categories_list: '.$categories_list);

  $category_slug_list = $country_sitemaps[$i]['category_url_slugs'];
  $category_slug = explode(',',$category_slug_list);
  if($debug) echo $category_slug_list.'<br>';
  cronLog('--> category_slug_list: '.$category_slug_list);

  $priority_list = $country_sitemaps[$i]['sitemap_priority'];
  $xml_priority = explode(',',$priority_list);
  if($debug) echo $priority_list.'<br>';
  cronLog('--> priority_list: '.$priority_list);
  
  $status_list = $country_sitemaps[$i]['db_status_column'];
  $status = explode(',',$status_list);
  if($debug) echo $status_list.'<br>';
  cronLog('--> status_list: '.$status_list);

  $slug_list = $country_sitemaps[$i]['db_slug_column'];
  $slug = explode(',',$slug_list);
  if($debug) echo $status_list.'<br>';
  cronLog('--> slug_list: '.$slug_list."\n");
  
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

      $cnt = 0;

      while ($row = $result->fetch_array()) {
        $url = 'https://' . $COUNTRY_SUBDOMAIN . 'bizdir.online/'.$category_slug[$c].'/' . Get_Slug($row[$slug[$c]]);
        if($debug) echo $url.'<br>';

        $xmlBlock  = " <url>\n";
        $xmlBlock .= "   <loc>". $url ."</loc>\n";
        $xmlBlock .= "   <lastmod>". $now ."</lastmod>\n";
        $xmlBlock .= "   <priority>". $xml_priority[$c] ."</priority>\n";
        $xmlBlock .= " </url>\n";

        fwrite($siteMapFile, $xmlBlock);
        $cnt++;
      }

      fwrite($siteMapFile, $xmlFooter);
      fclose($siteMapFile);

      cronLog('=> `'.$category_slug[$c].'` Total URLs: '.$cnt);


      if($google_sitmap_ping){
        //result_google = urlPing('http://www.google.com/webmasters/sitemaps/ping?sitemap='.$siteMapUrl);
        $sitemapUrl = $siteMapUrl;
        $response = pingGoogle($sitemapUrl); 
        cronLog('=> google_sitmap_ping response: '.print_r($response,true));       
      } else {
        cronLog('=> google_sitmap_ping not active');
      }

      if($bing_sitmap_ping){
        // $result_bing = urlPing('http://www.bing.com/webmaster/ping.aspx?siteMap='.$siteMapUrl);
        $sitemapUrl = $siteMapUrl;
        $response = pingBing($sitemapUrl);  
        cronLog('=> bing_sitmap_ping response: '.print_r($response,true));     
      } else {
        cronLog('=> bing_sitmap_ping not active');
      }


    } else {
      if ($debug) echo 'NO DATA';
    }
  }
}

$conn->close();

if ($debug) echo 'END GENERATE SITEMAP';
cronLog("\n".'END GENERATE SITEMAP'."\n".str_repeat('=',80)."\n\n",'close');


/*****************************  F U N C T I O N   *****************************/
/******                             GET SLUG                            *******/
/******************************************************************************/
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

/*****************************  F U N C T I O N   *****************************/
/******                            PING GOOGLE                          *******/
/******************************************************************************/
function pingGoogle($sitemapUrl) {
  $googlePingUrl = 'http://www.google.com/ping?sitemap=' . urlencode($sitemapUrl);

  $curl = curl_init($googlePingUrl);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($curl);
  curl_close($curl);

  // Optionally, you can check the response for success or errors
  return $response;
}


/*****************************  F U N C T I O N   *****************************/
/******                            PING BING                            *******/
/******************************************************************************/
function pingBing($sitemapUrl) {
  $bingPingUrl = 'http://www.bing.com/ping?sitemap=' . urlencode($sitemapUrl);

  $curl = curl_init($bingPingUrl);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($curl);
  curl_close($curl);

  // Optionally, you can check the response for success or errors
  return $response;
}



/*****************************  F U N C T I O N   *****************************/
/******                             CRON LOG                            *******/
/******************************************************************************/
function cronLog($txt,$action=''){
    global $_log_content_new, $_log_content_old, $logBasePath, $logFolder, $logFileName, $debug;

    if($action == 'open'){

        $_log_content_new = "";
        $_log_content_old = "";
        $_log_content_new .= $txt.' | '.date("F j, Y, g:i a")."\n";

    } elseif($action == 'close'){
        $_log_content_new .= $txt."\n\n";

        $cronJobLog = $logBasePath."/".$logFolder."/".$logFileName."-".date('Ym').".log";

        if(file_exists($cronJobLog)){
            $_log_content_old = file_get_contents($cronJobLog);
        }

        $cronLogHandle = fopen($cronJobLog, "w");
        $_txt = $_log_content_new.$_log_content_old;
        fwrite($cronLogHandle, $_txt);
        fclose($cronLogHandle);


    } else {
        $_log_content_new .= $txt."\n";
    }

}
?>