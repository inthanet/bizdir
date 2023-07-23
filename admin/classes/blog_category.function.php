<?php

//Get All Categories
function getAllBlogCategories()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "blog_categories ORDER BY category_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Categories order by position Id
function getAllBlogCategoriesPos()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "blog_categories ORDER BY category_filter_pos_id ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Active Categories order by position Id
function getAllActiveBlogCategoriesPos()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "blog_categories WHERE category_filter = 0 ORDER BY category_filter_pos_id ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular Category using category id
function getBlogCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "blog_categories where category_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Category using category name
function getNameBlogCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "blog_categories where category_name='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Category using category name
function getSlugBlogCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "blog_categories where category_slug='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Category Name using category id
function getBlogCategoryName($arg)
{
    global $conn;

    $sql = "SELECT category_name FROM  " . TBL . "blog_categories where category_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row[0];

}

//Get particular Category Name using category id
function getBlogCategorySlug($arg)
{
    global $conn;

    $sql = "SELECT category_slug FROM  " . TBL . "blog_categories where category_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row[0];

}

//Get All Category Count
function getCountBlogCategory()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "blog_categories ORDER BY category_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Sub Category Count using Category Id
function getCountCategoryBlogCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "blog_categories WHERE category_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}