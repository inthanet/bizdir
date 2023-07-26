<?php

//Get All Super Admin
function getAllSuperAdmin()
{
    global $conn;

    $sql = "SELECT * FROM " .  TBL . "admin WHERE admin_type = 'Super Admin'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All Sub Admins
function getAllSubAdmin()
{
    global $conn;

    $sql = "SELECT * FROM " .  TBL . "admin WHERE admin_type = 'Sub Admin' ORDER BY admin_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular admin using admin id
function getAdmin($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " .  TBL . "admin where admin_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

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