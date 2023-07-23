<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['city_submit'])) {

        $city_id = $_POST['city_id'];


        $city_qry = " DELETE FROM  " . TBL . "news_cities  WHERE city_id='" . $city_id . "'";


        $city_res = mysqli_query($conn,$city_qry);


        if ($city_res) {

            $_SESSION['status_msg'] = "News City has been Permanently Deleted!!!";


            header('Location: admin-all-news-city.php');
        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: admin-news-city-delete.php?row=' . $city_id);
        }

        //    News City Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: admin-all-news-city.php');
}