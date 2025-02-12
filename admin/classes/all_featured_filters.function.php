<?php

//Get All Featured Filter
function getAllFeaturedFilter()
{
    global $conn;

    $sql = "SELECT * FROM " . COUNTRY_PREFIX . "all_featured_filters ORDER BY all_featured_filter_id ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Active Featured Filter
function getAllActiveFeaturedFilter()
{
    global $conn;

    $sql = "SELECT * FROM " . COUNTRY_PREFIX . "all_featured_filters WHERE all_featured_filter_status = 1 ORDER BY all_featured_filter_id ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular Feature using feature value
function getValueFeaturedFilter($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . COUNTRY_PREFIX . "all_featured_filters where all_featured_filter_value='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}