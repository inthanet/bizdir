<?php

include('config/info.php');

if (isset($_POST['listing_submit'])) {

// Service Provided Details
    $_SESSION['listing_codea'] = $_POST["listing_codea"];
    $_SESSION['listing_id'] = $_POST["listing_id"];
    $_SESSION['google_map'] = $_POST["google_map"];
    //$_SESSION['360_view'] = $_POST["360_view"];

    $listing_video123 = $_POST["listing_video"];

    // Listing Video

    $prefix6 = $fruitList = '';
    foreach ($listing_video123 as $fruit6) {
        $listing_video1 = $prefix6 . $fruit6;
        $listing_video .= addslashes($listing_video1);
        $prefix6 = '|';
    }

    $_SESSION['listing_video'] = $listing_video;

    // ************************  Gallery Image Upload starts  **************************

    $gallery_image_old = $_POST["gallery_image_old"];

    $_SESSION['gallery_image1'] = $_POST["gallery_image_old"];

    $all_gallery_image = $_FILES['gallery_image'];
    $all_gallery_image23 = $_FILES['gallery_image']['name'];

        for ($k = 0; $k < count($all_gallery_image23); $k++) {


            if (!empty($all_gallery_image['name'][$k])) {
                $file1 = rand(1000, 100000) . $all_gallery_image['name'][$k];
                $file_loc1 = $all_gallery_image['tmp_name'][$k];
                $file_size1 = $all_gallery_image['size'][$k];
                $file_type1 = $all_gallery_image['type'][$k];
                $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
                if (in_array($file_type1, $allowed)) {
                    $folder1 = "images/listings/";
                    $new_size = $file_size1 / 1024;
                    $new_file_name1 = strtolower($file1);
                    $event_image1 = str_replace(' ', '-', $new_file_name1);
                    //move_uploaded_file($file_loc1, $folder1 . $event_image1);
                    $gallery_image1[] = compressImage($event_image1, $file_loc1, $folder1, $new_size);
                } else {
                    $gallery_image1[] = '';
                }
            }
            if ($gallery_image1 != NULL) {
                $gallery_image = implode(",", $gallery_image1);
            } else {
                $gallery_image = '';
            }
        }

// ************************  Gallery Image Upload ends  **************************

    $_SESSION['gallery_image'] = $gallery_image;

}

if($_SESSION['gallery_image'] != NULL){
    $v_gallery_image = $_SESSION['gallery_image'];
}else{
    $v_gallery_image = $_SESSION['gallery_image1'];
}

$listing_qry =
    "UPDATE  " . TBL . "listings  SET gallery_image='" . $v_gallery_image . "', google_map='" . $_SESSION['google_map'] . "'
    ,listing_video ='" . $_SESSION['listing_video'] . "'
     where listing_id='" . $_SESSION['listing_id'] . "'";


//   ***************************** Listing Update Part Starts *****************************

$listing_res = mysqli_query($conn, $listing_qry);


//****************************    Admin Primary email fetch starts    *************************

$admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
$admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
$admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
$admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
$admin_site_name = $admin_primary_email_fetchrow['website_address'];
$admin_address = $admin_primary_email_fetchrow['footer_address'];

//****************************    Admin Primary email fetch ends    *************************

if ($listing_res) {

    $admin_email = $admin_primary_email; // Admin Email Id

    $webpage_full_link_with_login = $webpage_full_link . "login";  //URL Login Link

//****************************    Admin email starts    *************************

    $to = $admin_email;
    $LISTING_UPDATE_ADMIN_SUBJECT = $BIZBOOK['LISTING_UPDATE_ADMIN_SUBJECT'];
    $subject = "$admin_site_name $LISTING_UPDATE_ADMIN_SUBJECT";

    $admin_sql_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "mail  WHERE mail_id = 9 "); //admin mail template fetch
    $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);

    $mail_template_admin = $admin_sql_fetch_row['mail_template'];

    $message1 = stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
    , '\' . $mobile_number . \'', '\' . $listing_name . \'', '\' . $listing_email . \'', '\' . $listing_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'', '\'.$webpage_full_link_with_login.\'', '\'.$admin_primary_email.\''),
        array('' . $admin_site_name . '', '' . $first_name . '', '' . $email_id . '', '' . $mobile_number . '', '' . $listing_name . '', '' . $listing_email . '', '' . $listing_mobile . '', '' . $admin_footer_copyright . '', '' . $admin_address . '', '' . $webpage_full_link . '', '' . $webpage_full_link_with_login . '', '' . $admin_primary_email . ''), $mail_template_admin));


    $headers = "From: " . "$email_id" . "\r\n";
    $headers .= "Reply-To: " . "$email_id" . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";


    mail($to, $subject, $message1, $headers); //admin email


//****************************    Admin email ends    *************************

//****************************    Client email starts    *************************

    $to1 = $email_id;
    $LISTING_UPDATE_CLIENT_SUBJECT = $BIZBOOK['LISTING_UPDATE_CLIENT_SUBJECT'];
    $subject1 = "$admin_site_name $LISTING_UPDATE_CLIENT_SUBJECT";

    $client_sql_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "mail  WHERE mail_id = 8 "); //User mail template fetch
    $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

    $mail_template_client = $client_sql_fetch_row['mail_template'];

    $message2 = stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
    , '\' . $mobile_number . \'', '\' . $listing_name . \'', '\' . $listing_email . \'', '\' . $listing_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'', '\'.$webpage_full_link_with_login.\'', '\'.$admin_primary_email.\''),
        array('' . $admin_site_name . '', '' . $first_name . '', '' . $email_id . '', '' . $mobile_number . '', '' . $listing_name . '', '' . $listing_email . '', '' . $listing_mobile . '', '' . $admin_footer_copyright . '', '' . $admin_address . '', '' . $webpage_full_link . '', '' . $webpage_full_link_with_login . '', '' . $admin_primary_email . ''), $mail_template_client));


    $headers1 = "From: " . "$admin_email" . "\r\n";
    $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
    $headers1 .= "MIME-Version: 1.0\r\n";
    $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";


    mail($to1, $subject1, $message2, $headers1); //admin email

//****************************    client email ends    *************************

// Basic Personal Details
    unset($_SESSION['first_name']);
    unset($_SESSION['last_name']);
    unset($_SESSION['mobile_number']);
    unset($_SESSION['email_id']);
    unset($_SESSION['listing_id']);

    unset($_SESSION['register_mode']);
    unset($_SESSION['user_status']);

// Common Listing Details
    unset($_SESSION['listing_name']);
    unset($_SESSION['listing_mobile']);
    unset($_SESSION['listing_email']);
    unset($_SESSION['listing_website']);
    unset($_SESSION['listing_address']);
    unset($_SESSION['listing_description']);
    unset($_SESSION['category_id']);
    unset($_SESSION['sub_category_id']);

    unset($_SESSION['country_id']);
    unset($_SESSION['state_id']);
    unset($_SESSION['city_id']);
    unset($_SESSION['profile_image']);
    unset($_SESSION['cover_image']);

    unset($_SESSION['service_id']);
    unset($_SESSION['service_image']);

    unset($_SESSION['service_1_name']);
    unset($_SESSION['service_1_price']);
    unset($_SESSION['service_1_detail']);
    unset($_SESSION['service_1_image']);

    unset($_SESSION['google_map']);
    unset($_SESSION['360_view']);
    unset($_SESSION['gallery_image']);
    unset($_SESSION['gallery_image1']);
    unset($_SESSION['listing_video']);

    unset($_SESSION['listing_info_question']);
    unset($_SESSION['listing_info_answer']);
    unset($_SESSION['mon_is_open']);
    unset($_SESSION['mon_open_time']);
    unset($_SESSION['mon_close_time']);

    unset($_SESSION['tue_is_open']);
    unset($_SESSION['tue_open_time']);
    unset($_SESSION['tue_close_time']);

    unset($_SESSION['wed_is_open']);
    unset($_SESSION['wed_open_time']);
    unset($_SESSION['wed_close_time']);

    unset($_SESSION['thu_is_open']);
    unset($_SESSION['thu_open_time']);
    unset($_SESSION['thu_close_time']);

    unset($_SESSION['fri_is_open']);
    unset($_SESSION['fri_open_time']);
    unset($_SESSION['fri_close_time']);

    unset($_SESSION['sat_is_open']);
    unset($_SESSION['sat_open_time']);
    unset($_SESSION['sat_close_time']);

    unset($_SESSION['sun_is_open']);
    unset($_SESSION['sun_open_time']);
    unset($_SESSION['sun_close_time']);

    header('Location: edit-listing-step-6?code=' . $_SESSION['listing_codea']);
    exit;
} else {

    $_SESSION['status_msg'] = $BIZBOOK['OOPS_SOMETHING_WENT_WRONG'];

    header('Location: edit-listing-step-1?row=' . $_SESSION['listing_codea']);
}