<?php

function getAllCitiesList($country)
{
    global $conn;

    $sql = "SELECT * FROM " . COUNTRY_PREFIX . "cities WHERE country_id = '".$country."' ORDER BY city_name  ASC";
    $rs = mysqli_query($conn, $sql);
    
    $logfile = fopen('/home/bizdir/public_html/logs/getAllCitiesList.log', 'a'); 
    fwrite($logfile, $sql.'\n');

    return $rs;
}

function getAllCities()
{
    global $conn;

    $sql = "SELECT * FROM " . COUNTRY_PREFIX . "cities GROUP BY city_name ORDER BY city_name  ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All city with given city Id
function getCity($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . COUNTRY_PREFIX . "cities where city_id='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All city with given city name
function getCityName($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . COUNTRY_PREFIX . "cities where city_name='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}
//Get All City Count
function getCountCity()
{
    global $conn;

    $sql = "SELECT * FROM " . COUNTRY_PREFIX . "cities ORDER BY city_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

