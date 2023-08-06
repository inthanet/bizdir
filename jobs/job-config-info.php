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


$current_page = basename($_SERVER['PHP_SELF']);

$job_base = 'jobs/';

$current_job_page = $job_base.$current_page;
?>