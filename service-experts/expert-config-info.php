<?php

if(file_exists('../admin/config/db.php'))
{
    include('../admin/config/db.php');
}

if (file_exists('../admin/classes/index.function.php')) {
    include('../admin/classes/index.function.php');
}

if(file_exists('../admin/config/config.php'))
{
    include('../admin/config/config.php');
}

$footer_row = getAllFooter(); //Fetch Footer Data

if($footer_row['admin_language']== 1) {
    if (file_exists('../admin/config/all_texts_english.php')) {
        include('../admin/config/all_texts_english.php');
    }
}elseif($footer_row['admin_language']== 2) {
    if (file_exists('../admin/config/all_texts_arabic.php')) {
        include('../admin/config/all_texts_arabic.php');
    }
}elseif($footer_row['admin_language']== 3) {
    if (file_exists('../admin/config/all_texts_french.php')) {
        include('../admin/config/all_texts_french.php');
    }
}elseif($footer_row['admin_language']== 4) {
    if (file_exists('../admin/config/all_texts_spanish.php')) {
        include('../admin/config/all_texts_spanish.php');
    }
}else{
    if (file_exists('../admin/config/all_texts_english.php')) {
        include('../admin/config/all_texts_english.php');
    }
}

$current_page = basename($_SERVER['PHP_SELF']);

$expert_base = 'service-experts/';

$current_expert_page = $expert_base.$current_page;
?>