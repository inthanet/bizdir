<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if(isset($_GET['approveclaimrequestapproveclaimrequestapproveclaimrequestapproveclaimrequestapproveclaimrequest'])){

    $sender_id = $_GET['approveclaimrequestapproveclaimrequestapproveclaimrequestapproveclaimrequestapproveclaimrequest'];
    $listing_id = $_GET['listing_id'];
    $claim_id = $_GET['claim_id'];


    $listing_qry =
        "UPDATE  " . TBL . "listings  SET user_id='" . $sender_id . "' where listing_id='" . $listing_id . "'";

    $listing_res = mysqli_query($conn,$listing_qry);

    $listing_qry1 =
        "UPDATE  " . TBL . "claim_listings  SET claim_status= 1 where claim_listing_id='" . $claim_id . "'";

    $listing_res1 = mysqli_query($conn,$listing_qry1);

    $sql = "SELECT * FROM  " . TBL . "users where user_id='" . $sender_id . "'";
    $rs = mysqli_query($conn, $sql);
    $user_row = mysqli_fetch_array($rs);

    $sql1 = "SELECT * FROM  " . TBL . "listings where listing_id='" . $listing_id . "'";
    $rs1 = mysqli_query($conn, $sql1);
    $liiiist_row = mysqli_fetch_array($rs1);

    $user_email_id = $user_row['email_id'];
    $first_name = $user_row['first_name'];

    $listing_name = $liiiist_row['listing_name'];



    if ($listing_res) {

        //****************************    Admin Primary email fetch starts    *************************

        $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_address = $admin_primary_email_fetchrow['footer_address'];

        //****************************    Admin Primary email fetch ends    *************************

        $admin_email = $admin_primary_email; // Admin Email Id


//****************************    Client email starts    *************************

        $to1 = $user_email_id;
        $subject1 = "$admin_site_name Claim This Business - Approved";

        $admin_email = $admin_primary_email; // Admin Email Id

        $webpage_full_link_with_login = $webpage_full_link. "login";  //URL Login Link
        

        $admin_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail WHERE mail_id = 25 "); //Admin mail template fetch
        $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);

        $mail_template_admin = $admin_sql_fetch_row['mail_template'];

        $message1 =   stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $listing_name . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'','\'.$webpage_full_link_with_login.\'','\'.$admin_primary_email.\''),
            array(''.$admin_site_name.'', '' . $first_name . '', '' . $listing_name . '', ''.$admin_footer_copyright.'', ''.$admin_address.'', ''.$webpage_full_link.'',''.$webpage_full_link_with_login.'',''.$admin_primary_email.''), $mail_template_admin));


        $headers1 = "From: " . "$admin_email" . "\r\n";
        $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
        $headers1 .= "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";


        mail($to1, $subject1, $message1, $headers1); //Client email

        $_SESSION['status_msg'] = "Claim Request has been Approved Successfully!!!";

        header('Location: admin-claim-listing.php');
    } else {

        $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

        header('Location: admin-claim-listing.php');
    }


}else{
    header('Location: admin-claim-listing.php');
    exit();
}