<?php

//Get All Listing Filter
function getAllListingFilter()
{
    global $conn;

    $sql = "SELECT * FROM " . COUNTRY_PREFIX . "all_listing_filters WHERE all_listing_filter_id = 1";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}