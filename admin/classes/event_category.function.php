<?php

//Get All Categories
function getAllEventCategories()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "event_categories ORDER BY category_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Categories order by position Id
function getAllEventCategoriesPos()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "event_categories ORDER BY category_filter_pos_id ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Active Categories order by position Id
function getAllActiveEventCategoriesPos()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "event_categories WHERE category_filter = 0 ORDER BY category_filter_pos_id ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular Category using category id
function getEventCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "event_categories where category_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Category using category name
function getNameEventCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "event_categories where category_name='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Category using category name
function getSlugEventCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "event_categories where category_slug='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Category Name using category id
function getEventCategoryName($arg)
{
    global $conn;

    $sql = "SELECT category_name FROM  " . TBL . "event_categories where category_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row[0];

}

//Get particular Category Name using category id
function getEventCategorySlug($arg)
{
    global $conn;

    $sql = "SELECT category_slug FROM  " . TBL . "event_categories where category_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row[0];

}

//Get All Category Count
function getCountEventCategory()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "event_categories ORDER BY category_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Sub Category Count using Category Id
function getCountCategoryEventCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "event_categories WHERE category_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}