<?php

//Get All Popular Tags
function getAllPopularTags($bizdir = NULL)
{
    global $conn;
    if(!empty($bizdir) AND $bizdir == 1){
        $sql = "SELECT * FROM " . COUNTRY_PREFIX . "popular_tags where popular_tags_bizdir = 1 ORDER BY popular_tags_id ASC";
        $rs = mysqli_query($conn, $sql);
        return $rs;
    } else{
        $sql = "SELECT * FROM " . COUNTRY_PREFIX . "popular_tags ORDER BY popular_tags_id DESC";
        $rs = mysqli_query($conn, $sql);
        return $rs;        
    }    

}

//Get Popular Tags with given Tag Id
function getPopularTags($arg, $bizdir = NULL)
{
    global $conn;

    if(!empty($bizdir) AND $bizdir == 1){
        $sql = "SELECT * FROM " . COUNTRY_PREFIX . "popular_tags where popular_tags_id = '" . $arg . "' AND popular_tags_bizdir = 1'";
        $rs = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($rs);
        return $row;
    } else {
        $sql = "SELECT * FROM " . COUNTRY_PREFIX . "popular_tags where popular_tags_id = '" . $arg . "'";
        $rs = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($rs);
        return $row;
    }


}