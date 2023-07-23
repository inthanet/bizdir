<?php

//Get All News Cities
function getAllNewsCities()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "news_cities ORDER BY city_name ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All News Cities
function getAllNewsCitiesOrderId()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "news_cities ORDER BY city_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All News city with given city Id
function getNewsCity($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "news_cities where city_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All News city with given city Name
function getNewsCityName($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "news_cities where city_name='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All News City Count
function getCountNewsCity()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "news_cities ORDER BY city_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}