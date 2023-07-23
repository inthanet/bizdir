<?php

//database configuration
if (file_exists('expert-config-info.php')) {
    include "expert-config-info.php";
}

 $select_search = $_REQUEST['select_search'];
 $select_city = $_REQUEST['select_city'];


//get matched data from expert categories table
$categories_qry = "SELECT * FROM " . TBL . "expert_categories WHERE category_slug = '$select_search' ";

$categories_query = mysqli_query($conn,$categories_qry);

if (mysqli_num_rows($categories_query) > 0) {

    //get matched data from cities table starts

    $cities_qry = "SELECT * FROM " . TBL . "expert_cities WHERE country_id = '$select_city'";
    $cities_query = mysqli_query($conn, $cities_qry);
    $cities_row = mysqli_fetch_array($cities_query);

    $city_name = $cities_row['country_name'];

    //get matched data from cities table ends

    $category_name = $select_search;

    $p_category_name = preg_replace('/\s+/', '-', strtolower($category_name));
    $p_url = $ALL_EXPERTS_URL . urlModifier($p_category_name);

    if ($city_name != NULL && !empty($city_name)) {
        $p_city_name = preg_replace('/\s+/', '-', strtolower($city_name));

        $final_url = $p_url . '?home_city=' . $p_city_name;
    } else {
        $final_url = $p_url;
    }

    header("location: $final_url");
    exit;

}else{

    header("location: ../search-results?q=$select_search");
    exit;
}

?>