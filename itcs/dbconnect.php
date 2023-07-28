<?php

define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'bizdir_adm');//ENTER YOUR DB USERNAME
define('DB_PASSWORD', 'p01c2kr_2561');//ENTER YOUR DB PASSWORD
define('DB_NAME', 'bizdir_dbase');//ENTER YOUR DB NAME



# Connection to the database. #
$conn = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD)
or die('Unable to connect to MySQL');

# Select a database to work with. #
$selected = mysqli_select_db($conn, DB_NAME)
or die('Unable to connect to Database');

$conn -> set_charset("utf8");

