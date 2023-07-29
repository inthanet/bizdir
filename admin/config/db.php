<?php
# Prevent warning. #
//error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING | E_STRICT);

ob_start();
 
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'bizdir_adm');//ENTER YOUR DB USERNAME
define('DB_PASSWORD', 'p01c2kr_2561');//ENTER YOUR DB PASSWORD
define('DB_NAME', 'bizdir_dbase');//ENTER YOUR DB NAME

# SUB DOMAIN
$subdomain = substr($_SERVER['HTTP_HOST'], 0, strpos($_SERVER['HTTP_HOST'], '.')); 



// Set the appropriate country prefix based on the subdomain
switch ($subdomain) {
    case 'en':
        define('COUNTRY_PREFIX', $subdomain.'_');
        define('COUNTRY_SUBDOMAIN', $subdomain.'.');
        define('COUNTRY_FOLDER', '/'.$subdomain.'/');
        define('COUNTRY_ID', '001'); 
        define('COUNTRY_NAME', 'USA');
        define('COUNTRY_LANG', 'en');   
        define('COUNTRY_TIMEZONE', 'Europe/London');      
        define('COUNTRY_REQUIRED_LISTING_NAME_EN', false);  

        break;
    case 'de':
        define('COUNTRY_PREFIX', $subdomain.'_');
        define('COUNTRY_SUBDOMAIN', $subdomain.'.');
        define('COUNTRY_FOLDER', '/'.$subdomain.'/');
        define('COUNTRY_ID', '49');
        define('COUNTRY_NAME', 'Germany');
        define('COUNTRY_LANG', 'de');
        define('COUNTRY_TIMEZONE', 'Europe/Berlin');
        define('COUNTRY_REQUIRED_LISTING_NAME_EN', false);  
        break;     
    case 'fr':
        define('COUNTRY_PREFIX', $subdomain.'_');
        define('COUNTRY_SUBDOMAIN', $subdomain.'.');
        define('COUNTRY_FOLDER', '/'.$subdomain.'/');
        define('COUNTRY_ID', '33');
        define('COUNTRY_NAME', 'France');
        define('COUNTRY_LANG', 'fr');
        define('COUNTRY_TIMEZONE', 'Europe/Paris');
        define('COUNTRY_REQUIRED_LISTING_NAME_EN', false);  
        break;                     
    default:
        //main prefix
        define('COUNTRY_PREFIX', 'ww_');
        define('COUNTRY_SUBDOMAIN', '');
        define('COUNTRY_FOLDER', '');
        define('COUNTRY_ID', '001'); 
        define('COUNTRY_NAME', 'USA');
        define('COUNTRY_LANG', 'en');
        define('COUNTRY_TIMEZONE', 'America/New_York');
        define('COUNTRY_REQUIRED_LISTING_NAME_EN', false);  
}

// Print user-defined constants
// echo "User-defined constants:<br>";
// $constants = get_defined_constants(true);
// foreach ($constants['user'] as $name => $value) {
//     echo "$name = $value.'<br>";
// }
// die();


$webpage_full_link_url = "https://".COUNTRY_SUBDOMAIN."bizdir.online/";  #Important Please Paste your WebPage Full URL (i.e https://bizbookdirectorytemplate.com/)


# Connection to the database. #
$conn = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD)
or die('Unable to connect to MySQL');

# Select a database to work with. #
$selected = mysqli_select_db($conn, DB_NAME)
or die('Unable to connect to Database');

$conn -> set_charset("utf8");

session_start(); # Session start. #

$timezone = "Asia/Hong_Kong";
if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
$curDate = date('Y-m-d H:i:s');

define('TBL', 'ww_');

$sql = "SELECT * FROM " .COUNTRY_PREFIX. "footer WHERE footer_id = 1";

$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($rs);



if ($webpage_full_link_url) {
    $webpage_full_link = $webpage_full_link_url;
} else {
    $webpage_full_link_db = $row['website_complete_url'];
    $webpage_full_link = $webpage_full_link_db;
}

