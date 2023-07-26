<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */
$debug = false;
if($debug) $logfile = fopen('/home/bizdir/public_html/logs/insert-city.log', 'a'); 

include "config/info.php";

if (file_exists('config/google_api.php')) {
    include('config/google_api.php');
}

if (isset($_POST['city_submit'])) {

    if($_POST['city_name'] != NULL){
        $cnt = count($_POST['city_name']);
    }
    $country_id = $_POST['country_id'];

// *********** if Count of city name is zero means redirect starts ********

    if ($cnt == 0) {
        header('Location: admin-add-city.php');
        exit;
    }

// *********** if Count of city name is zero means redirect ends ********

    for ($i = 0; $i < $cnt; $i++) {

        $city_name = $_POST['city_name'][$i];

        $state_sql = "SELECT * FROM  " . COUNTRY_PREFIX . "states where country_id='" . $country_id . "'";
        $state_rs = mysqli_query($conn, $state_sql);
        while ($state_row = mysqli_fetch_array($state_rs)) {

//************ city Name Already Exist Check Starts ***************


            $city_name_exist_check = mysqli_query($conn, "SELECT * FROM " . COUNTRY_PREFIX . "cities  WHERE city_name='" . $city_name . "' AND state_id='" . $state_row['state_id'] . "' ");

            if (mysqli_num_rows($city_name_exist_check) > 0) {


                $_SESSION['status_msg'] = "The Given City name $city_name is Already Exist Try Other!!!";

                header('Location: admin-add-city.php');
                exit;


            }
        }

//************ city Name Already Exist Check Ends ***************


        // $_FILES['city_image']['name'][$i];

        // if (!empty($_FILES['city_image']['name'][$i])) {
        //     $file = rand(1000, 100000) . $_FILES['city_image']['name'][$i];
        //     $file_loc = $_FILES['city_image']['tmp_name'][$i];
        //     $file_size = $_FILES['city_image']['size'][$i];
        //     $file_type = $_FILES['city_image']['type'][$i];
        //     $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
        //     if (in_array($file_type, $allowed)) {
        //         $folder = "../images/services/";
        //         $new_size = $file_size / 1024;
        //         $new_file_name = strtolower($file);
        //         $event_image = str_replace(' ', '-', $new_file_name);
        //         //move_uploaded_file($file_loc, $folder . $event_image);
        //         $city_image = compressImage($event_image, $file_loc, $folder, $new_size);
        //     } else {
        //         $city_image = '';
        //     }
        // }

        if(GOOGLE_MAPS_API_KEY != 'none'){

            $apiKey      = GOOGLE_MAPS_API_KEY;
            $country_id  = COUNTRY_ID;
            $language    = COUNTRY_LANG;

            $result = getLatLngForCity($city_name, $country, $language, $apiKey);
            $city_lat   = $result['latitude'];
            $city_lng   = $result['longitude'];
            $state_name = $result['state'];
        } else {
            
            $city_lat = null; $city_lng = null; $state_id = null; $state_name = null;
        }    

        $check_qry = "SELECT * FROM " . COUNTRY_PREFIX . "states WHERE state_name='" . $state_name . "' LIMIT 1";
        $check_qry_res = mysqli_query($conn,$check_qry);

        if (!is_null($state_name) && isset($check_qry_res) && $check_qry_res->num_rows == 0) {

            $sqlState= mysqli_query($conn, "INSERT INTO  " . COUNTRY_PREFIX . "states (state_name, country_id)
            VALUES ('$state_name', $country_id)"); 

            $state_id = $last_insert_id = $conn->insert_id;
        
        } elseif (!is_null($state_name) && isset($check_qry_res) && $check_qry_res->num_rows > 0) {

            $row = mysqli_fetch_array($check_qry_res);
            $state_id = $row['state_id'];        
        }    




        $sqlCity ="INSERT INTO  " . COUNTRY_PREFIX . "cities (country_id, city_name, city_lat, city_lng, state_id, state_name, city_cdt)
                                                VALUES ( $country_id, 
                                                        '$city_name', 
                                                        '$city_lat', 
                                                        '$city_lng', 
                                                         $state_id ,
                                                        '$state_name',
                                                        '$curDate')";

        if($debug) fwrite($logfile, 'sqlCity :'.$sqlCity."\n");                                                        

        $sqlCity = mysqli_query($conn, $sqlCity);                                                        


    }


    if ($sqlCity) {

        $_SESSION['status_msg'] = "City(s) has been Added Successfully!!!";


        header('Location: admin-all-city.php');
        exit;

    } else {


        $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

        header('Location: admin-add-city.php');
        exit;
    }

}
?>