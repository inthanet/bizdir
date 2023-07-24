<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

# Prevent warning. #
error_reporting(0);
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
        define('SUBDOMAIN_COUNTRY', $subdomain.'.');
        break;
    case 'de':
        define('COUNTRY_PREFIX', $subdomain.'_');
        define('SUBDOMAIN_COUNTRY', $subdomain.'.');
        break;                
    default:
        //main prefix
        define('COUNTRY_PREFIX', 'ww_');
        define('SUBDOMAIN_COUNTRY', $subdomain.'.');
}

$webpage_full_link_url = "https://".SUBDOMAIN_COUNTRY."bizdir.online/";  #Important Please Paste your WebPage Full URL (i.e https://bizbookdirectorytemplate.com/)


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

# TABLE PREFIX # //<!--ui -->
$country_table_list = 'all_featured_filters,all_listing_filters,all_texts,blog_categories,blogs,categories,chat_links';
define('TBL', 'ww_');

$sql = "SELECT * FROM " .COUNTRY_PREFIX. "footer WHERE footer_id = 1";
//$sql = "SELECT * FROM de_footer WHERE footer_id = 1";
//$sql = "SELECT * FROM " .TBL. "footer WHERE footer_id = 1";

$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($rs);



if ($webpage_full_link_url) {
    $webpage_full_link = $webpage_full_link_url;
} else {
    $webpage_full_link_db = $row['website_complete_url'];
    $webpage_full_link = $webpage_full_link_db;
}


// Function to get the appropriate table prefix based on the subdomain and table name
if (!function_exists('getTablePrefix')) {
    function getTablePrefix($tableName) {
        global $country_table_list;

        // Check if the table name is in the country_table array
        //$countries = 'all_featured_filters,all_listing_filters,all_texts,blog_categories,blogs,categories,chat_links';
        $country_tables = explode(',', $country_table_list);
        
        if (in_array($tableName, $country_tables)) {
            
            // Get the subdomain from the request URL
            $subdomain = substr($_SERVER['HTTP_HOST'], 0, strpos($_SERVER['HTTP_HOST'], '.'));        
            
            
            // Set the appropriate table prefix based on the subdomain
            switch ($subdomain) {
                case 'en':
                    $tablePrefix = 'en_';
                    break;
                case 'de':
                    $tablePrefix = 'de_';
                    break;                
                default:
                    $tablePrefix = 'ww_';
            }
        }

        return $tablePrefix.$tableName;
    }
    
}