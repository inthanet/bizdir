<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

# Prevent warning. #
error_reporting(0);
ob_start();

define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', '');//ENTER YOUR DB USERNAME
define('DB_PASSWORD', '');//ENTER YOUR DB PASSWORD
define('DB_NAME', '');//ENTER YOUR DB NAME


$webpage_full_link_url = "";  #Important Please Paste your WebPage Full URL (i.e https://bizbookdirectorytemplate.com/)


# Connection to the database. #
$conn = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD)
or die('Unable to connect to MySQL');

# Select a database to work with. #
$selected = mysqli_select_db($conn, DB_NAME)
or die('Unable to connect to Database');

session_start(); # Session start. #

$timezone = "Asia/Calcutta";
if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
$curDate = date('Y-m-d H:i:s');

# TABLE PREFIX # //<!--ui -->
define('TBL', 'ww_');

$sql = "SELECT * FROM " .getTablePrefix('footer'). " WHERE footer_id = 1";
$rs = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($rs);

$webpage_full_link_db = $row['website_complete_url'];

if ($webpage_full_link_url) {

    $webpage_full_link = $webpage_full_link_url;
} else {
    
    $webpage_full_link = $webpage_full_link_db;
}

// Function to get the appropriate table prefix based on the subdomain and table name
function getTablePrefix($tableName) {

    // Check if the table name is in the country_table array
    $countries = 'all_featured_filters,all_listing_filters,all_texts,blog_categories,blogs,categories,chat_links';
    $country_tables = explode(',', $countries);
    
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