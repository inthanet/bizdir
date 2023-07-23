<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD']=='POST') {
//    Claim Insert Part Starts

    $service_name = $_POST["service_name"];
    $service_price = $_POST["service_price"];

    $listing_id = $_POST["listing_id"];

    $enquiry_sender_id = $_POST["enquiry_sender_id"];
    $claim_status = 0;
    
    $enquiry_name = $_POST["enquiry_name"];
    $enquiry_email = $_POST["enquiry_email"];
    $enquiry_mobile = $_POST["enquiry_mobile"];
    $enquiry_message = $_POST["enquiry_message"];

//    $payment_status = "Pending";

//    if($listing_user_id == $enquiry_sender_id){
//
//        echo '3';  // Enquiring User Id and Owner Id is Same
//        exit();
//    }

    $listing_row = getIdListing($listing_id);

    $listing_user_id = $listing_row['user_id'];
    $listing_name = $listing_row['listing_name'];

    $user_row = getUser($listing_user_id);

    $user_email_id = $user_row['email_id'];
    $first_name = $user_row['first_name'];
    $password = $user_row['password'];

    if (!empty($_FILES['enquiry_image']['name'])) {
        $file = rand(1000, 100000) . $_FILES['enquiry_image']['name'];
        $file_loc = $_FILES['enquiry_image']['tmp_name'];
        $file_size = $_FILES['enquiry_image']['size'];
        $file_type = $_FILES['enquiry_image']['type'];
        $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
        if(in_array($file_type, $allowed)) {
            $folder = "images/listings/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $enquiry_image_1 = str_replace(' ', '-', $new_file_name);
            //move_uploaded_file($file_loc, $folder . $enquiry_image_1);
            $enquiry_image = compressImage($enquiry_image_1, $file_loc, $folder, $new_size);
        }else{
            $enquiry_image = '';
        }
    }


    if($user_email_id == $enquiry_email){

        //****************************    Admin Primary email fetch starts    *************************

        $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_address = $admin_primary_email_fetchrow['footer_address'];

        //****************************    Admin Primary email fetch ends    *************************

        $admin_email = $admin_primary_email; // Admin Email Id

        $webpage_full_link_with_login = $webpage_full_link. "login";  //URL Login Link


//****************************    Client email starts    *************************

            $to1 = $user_email_id;
            $subject1 = "$admin_site_name Claim This Business Request";

        $admin_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail WHERE mail_id = 24 "); //Admin mail template fetch
        $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);

        $mail_template_admin = $admin_sql_fetch_row['mail_template'];

        $message1 =   stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $listing_name . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'','\'.$webpage_full_link_with_login.\'','\'.$admin_primary_email.\''),
            array(''.$admin_site_name.'', '' . $first_name . '', '' . $listing_name . '', ''.$admin_footer_copyright.'', ''.$admin_address.'', ''.$webpage_full_link.'',''.$webpage_full_link_with_login.'',''.$admin_primary_email.''), $mail_template_admin));


        $headers1 = "From: " . "$admin_email" . "\r\n";
        $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
        $headers1 .= "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";


        mail($to1, $subject1, $message1, $headers1); //Client email

    }

    $enquiry_qry = "INSERT INTO " . TBL . "claim_listings 
					(listing_id, enquiry_sender_id, enquiry_name, enquiry_email, enquiry_image, enquiry_mobile,enquiry_message,claim_status, claim_cdt) 
					VALUES 
					('$listing_id', '$enquiry_sender_id', '$enquiry_name', '$enquiry_email', '$enquiry_image', '$enquiry_mobile','$enquiry_message', '$claim_status', '$curDate')";

    $enquiry_res = mysqli_query($conn,$enquiry_qry);

    $EnquiryID = mysqli_insert_id($conn);


    if ($enquiry_res) {
        if ($service_name == NULL) {
            echo '1';
        } else {
            echo $EnquiryID;
        }

    } else {
        echo '2';
    }
}else {

    header('Location: index');
    exit;
}

//    Enquiry Insert Part Ends

