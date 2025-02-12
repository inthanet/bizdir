<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if (file_exists('config/google_api.php')) {
    include('config/google_api.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['city_submit'])) {

        $city_id = $_POST['city_id'];
        $city_name = $_POST['city_name'];


//************ city Name Already Exist Check Starts ***************


        $city_name_exist_check = mysqli_query($conn, "SELECT * FROM " . COUNTRY_PREFIX . "cities  WHERE city_name='" . $city_name . "' AND city_id != $city_id ");

        if (mysqli_num_rows($city_name_exist_check) > 0) {


            $_SESSION['status_msg'] = "The Given city name is Already Exist Try Other!!!";

            header('Location: admin-city-edit.php?row=' . $city_id);
            exit;


        }

//************ city Name Already Exist Check Ends ***************


        $_FILES['city_image']['name'];

        if (!empty($_FILES['city_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['city_image']['name'];
            $file_loc = $_FILES['city_image']['tmp_name'];
            $file_size = $_FILES['city_image']['size'];
            $file_type = $_FILES['city_image']['type'];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/services/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $event_image = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $event_image);
                $city_image = compressImage($event_image, $file_loc, $folder, $new_size);
            } else {
                $city_image = $city_image_old;
            }
        } else {
            $city_image = $city_image_old;
        }

        $apiKey   = GOOGLE_MAPS_API_KEY;
        $country  = COUNTRY_NAME;
        $language = COUNTRY_LANG;

        $result = getLatLngForCity($city_name, $country, $language, $apiKey);

        if ($result) {

            $sqlQuery = "UPDATE  " . COUNTRY_PREFIX . "cities 
            SET country_id = '" . COUNTRY_ID . "', city_name = '" . $city_name . "' 
              , city_lat = '" . $result['latitude'] . "', city_lng = '" . $result['longitude'] . "'
              , state_id = '" .  $city_id . "', state_name = '" . $result['state'] . "'
            where city_id='" . $city_id . "'";             

        //    $logfile = fopen('/home/bizdir/public_html/logs/update-city.log', 'a'); 
        //    fwrite($logfile, 'SQL :'.$sql."\n");

           $sql = mysqli_query($conn, $sqlQuery);
        } else {
            
            $sql = mysqli_query($conn, "UPDATE  " . COUNTRY_PREFIX . "cities 
            SET city_name = '" . $city_name . "' where city_id = '" . $city_id . "'");
        }

        if ($sql) {


            $_SESSION['status_msg'] = "city has been Updated Successfully!!!";


            header('Location: admin-all-city.php');
            exit;

        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: admin-city-edit.php?row=' . $city_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: admin-all-city.php');
    exit;
}
?>