<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */
$debug = true;
if($debug) $logfile = fopen('/home/bizdir/public_html/logs/trash-city.log', 'a'); 


if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['city_submit'])) {

        $city_id   = $_POST['city_id'];
        $city_name = $_POST['city_name'];

        $sql_city_state_name = "SELECT state_name FROM " . COUNTRY_PREFIX . "cities WHERE city_id = '$city_id'";
        $res_city_state_name = mysqli_query($conn, $sql_city_state_name);
        
        if ($res_city_state_name && $res_city_state_name->num_rows > 0) {

            $row = mysqli_fetch_array($res_city_state_name);
            $state_name = $row['state_name'];
            if($debug) fwrite($logfile, 'state_name :'.$state_name."\n"); 
        }

        $city_qry = " DELETE FROM  " . COUNTRY_PREFIX . "cities  WHERE city_id='" . $city_id . "'";
        $city_res = mysqli_query($conn,$city_qry);

        $check_qry = "SELECT COUNT(*) AS num_rows FROM " . COUNTRY_PREFIX . "states WHERE state_name='" . $state_name . "'";
        $check_qry_res = mysqli_query($conn,$check_qry);

        if ($check_qry_res && $check_qry_res->num_rows == 1) {
            $state_qry = " DELETE FROM  " . COUNTRY_PREFIX . "states  WHERE state_name='" . $state_name . "'";
            $state_qry_res = mysqli_query($conn, $state_qry );
        }    
        

        if ($city_res) {

            $_SESSION['status_msg'] = "city has been Permanently Deleted!!!";


            header('Location: admin-all-city.php');
        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: admin-city-delete.php?row=' . $city_id);
        }

        //    Listing Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: admin-all-city.php');
}