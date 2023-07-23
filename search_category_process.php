<?php

//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}

$type_id = $_POST['type_id'];

if ($type_id == 1) {     //Listings Category

//get matched data from listing category table
    foreach (getAllCategoriesPos() as $row) {
        ?>
        <option value="<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?></option>
        <?php
    }
}elseif ($type_id == 2) {  //Service Experts Category

//get matched data from Service Experts category table
    foreach (getAllActiveExpertCategoriesPos() as $row) {
        ?>
        <option value="<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?></option>
        <?php
    }
}elseif ($type_id == 3) {  //Jobs Category

//get matched data from Jobs category table
    foreach (getAllJobCategories() as $row) {
        ?>
        <option value="<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?></option>
        <?php
    }
}elseif ($type_id == 4) {  //Places Category

//get matched data from Places category table
    foreach (getAllPlaceCategoriesPos() as $row) {
        ?>
        <option value="<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?></option>
        <?php
    }
}elseif ($type_id == 5) {  //News Category

//get matched data from News category table
    foreach (getAllNewsCategoriesPos() as $row) {
        ?>
        <option value="<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?></option>
        <?php
    }
}elseif ($type_id == 6) {  //Events Category

//get matched data from Events category table
    foreach (getAllEventCategories() as $row) {
        ?>
        <option value="<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?></option>
        <?php
    }
}elseif ($type_id == 7) {  //Products Category

//get matched data from products category table
    foreach (getAllProductCategories() as $row) {
        ?>
        <option value="<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?></option>
        <?php
    }
}elseif ($type_id == 9) {  //Blog Category

//get matched data from Blogs category table
    foreach (getAllBlogCategories() as $row) {
        ?>
        <option value="<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?></option>
        <?php
    }
}else{
    ?>
    <option value=""></option>
    <?php
}
?>