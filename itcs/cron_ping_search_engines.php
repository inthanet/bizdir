<?php
$debug = true;
date_default_timezone_set('Asia/Hong_Kong');

/*----------------------------------------------------------------------*/
$hline = str_repeat("-", 60);
$logfile     = $_SERVER['DOCUMENT_ROOT']."/storage/logs/cronlog.txt";
// Check Cron Log file if the file is > than 50KB, delete
if(file_exists($logfile)) {
    if (is_writable($logfile) && filesize($logfile) > (1024 * 50)) {
        //unlink($logfile);
        $log = fopen($logfile, "a");
        fwrite($log, "\n\n".'LOG FILE DELETION! | File Size:'.filesize($logfile). " \n\n");
        fclose($log);
    }
}
$log = fopen($logfile, "a");

$_txt = "\n\n".$hline."\n"."Log from : ".date("F j, Y, g:i a"). " \n";
fwrite($log, $_txt);
/*----------------------------------------------------------------------*/

$now = date('Y-m-d H:i:s',time());
$dayOffWeek = date('N',date(time()));     //1 = Monday,... 5 = Friday,... 0 = Sunday


$_txt = "\n"."START cron_ping_search_engines.php | V160521";
fwrite($log, $_txt);

$_txt = "\n"."GOOGLE products.xml Sitemap: ".urlPing('http://www.google.com/webmasters/sitemaps/ping?sitemap=https://'.$_SERVER['HTTP_HOST'].'/products.xml');
if($debug) print  $_txt.'<br>';
fwrite($log, $_txt);

$_txt = "\n"."GOOGLE images.xml Sitemap: ".urlPing('http://www.google.com/webmasters/sitemaps/ping?sitemap=https://'.$_SERVER['HTTP_HOST'].'/images.xml');
if($debug) print  $_txt.'<br>';
fwrite($log, $_txt);

if($dayOffWeek == 1 OR $dayOffWeek == 3 OR $dayOffWeek == 5){ // Monday, Wednesday and Friday
  $_txt = "\n"."GOOGLE posts.xml Sitemap: ".urlPing('http://www.google.com/webmasters/sitemaps/ping?sitemap=https://'.$_SERVER['HTTP_HOST'].'/posts.xml');
  if($debug) print  $_txt.'<br>';
  fwrite($log, $_txt);
}

$_txt = "\n"."BING products.xml Sitemap: ".urlPing('http://www.bing.com/webmaster/ping.aspx?siteMap=https://'.$_SERVER['HTTP_HOST'].'/products.xml');
if($debug) print  $_txt.'<br>';
fwrite($log, $_txt);


$_txt = "\n"."END cron_ping_search_engines.php : ".date("F j, Y, g:i a");
if($debug) print  $_txt.'<br>';
fwrite($log, $_txt);
fclose($log);

function urlPing($url=NULL)
{
    if($url == NULL) return false;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if($httpcode >=200 && $httpcode < 300){
        return 'OK ('.$httpcode.')';
    } else {
        return 'ATTENTION ('.$httpcode.')';
    }
}
?>