<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['blog_submit'])) {

        $blog_id = $_POST["blog_id"];

        $blog_image_old = $_POST["blog_image_old"];


// Basic Personal Details
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $mobile_number = $_POST["mobile_number"];
        $email_id = $_POST["email_id"];

        $register_mode = "Direct";
        $user_status = "Inactive";

// Common blog Details
        $blog_name = $_POST["blog_name"];
        $category_id = $_POST["category_id"];
        $blog_description = addslashes($_POST["blog_description"]);
        $isenquiry_old = $_POST["isenquiry"];
        $user_id = $_POST["user_id"];

        if ($isenquiry_old == "on") {
            $isenquiry = 1;
        } else {
            $isenquiry = 0;
        }

        $user_sql = "SELECT * FROM  " . TBL . "users where user_id='" . $user_id . "'";
        $user_rs = mysqli_query($conn, $user_sql);
        $usersqlrow = mysqli_fetch_array($user_rs);

        if ($usersqlrow['user_status'] == 'Active') {
            // Blog Status
            $blog_status = "Active";
        } else {
            // Blog Status
            $blog_status = "Inactive";
        }

// blog Status
//        $blog_status = "Active";
        // $blog_status = "Pending";
        $payment_status = "Pending";

        $blog_type_id = 1;


        if (!empty($_FILES['blog_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['blog_image']['name'];
            $file_loc = $_FILES['blog_image']['tmp_name'];
            $file_size = $_FILES['blog_image']['size'];
            $file_type = $_FILES['blog_image']['type'];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/blogs/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $blog_image_old1 = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $blog_image_old1);
                $blog_image = compressImage($blog_image_old1, $file_loc, $folder, $new_size);
            } else {
                $blog_image = $blog_image_old;
            }
        } else {
            $blog_image = $blog_image_old;
        }

        function checkBlogSlug($link, $blog_id, $counter = 1)
        {
            global $conn;
            $newLink = $link;
            do {
                $checkLink = mysqli_query($conn, "SELECT blog_id FROM " . COUNTRY_PREFIX . "blogs WHERE blog_slug = '$newLink' AND blog_id != '$blog_id'");
                if (mysqli_num_rows($checkLink) > 0) {
                    $newLink = $link . '' . $counter;
                    $counter++;
                } else {
                    break;
                }
            } while (1);

            return $newLink;
        }


        $blog_name1 = trim(preg_replace('/[^A-Za-z0-9]/', ' ', $blog_name));
        $blog_slug = checkBlogSlug($blog_name1, $blog_id);


        $blog_qry =
            "UPDATE  " . COUNTRY_PREFIX . "blogs  SET user_id='" . $user_id . "', blog_name='" . $blog_name . "'
            ,blog_description='" . $blog_description . "', category_id='" . $category_id . "'
      , blog_image='" . $blog_image . "', blog_status='" . $blog_status . "',  isenquiry='" . $isenquiry . "'
      , blog_slug='" . $blog_slug . "' where blog_id='" . $blog_id . "'";


        $blog_res = mysqli_query($conn, $blog_qry);

        //****************************    Admin Primary email fetch starts    *************************

        $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . COUNTRY_PREFIX . "footer  WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_address = $admin_primary_email_fetchrow['footer_address'];

        //****************************    Admin Primary email fetch ends    *************************

        if ($blog_res) {

            $admin_email = $admin_primary_email; // Admin Email Id

            $webpage_full_link_with_login = $webpage_full_link . "login";  //URL Login Link

//****************************    Admin email starts    *************************

            $to = $admin_email;
            $subject = "$admin_site_name - blog has been updated";

            $admin_sql_fetch = mysqli_query($conn, "SELECT * FROM " . COUNTRY_PREFIX . "mail  WHERE mail_id = 17 "); //admin mail template fetch
            $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);

            $mail_template_admin = $admin_sql_fetch_row['mail_template'];

            $message1 = stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
            , '\' . $mobile_number . \'', '\' . $blog_name . \'', '\' . $blog_email . \'', '\' . $blog_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'', '\'.$webpage_full_link_with_login.\'', '\'.$admin_primary_email.\''),
                array('' . $admin_site_name . '', '' . $first_name . '', '' . $email_id . '', '' . $mobile_number . '', '' . $blog_name . '', '' . $blog_email . '', '' . $blog_mobile . '', '' . $admin_footer_copyright . '', '' . $admin_address . '', '' . $webpage_full_link . '', '' . $webpage_full_link_with_login . '', '' . $admin_primary_email . ''), $mail_template_admin));


            $headers = "From: " . "$email_id" . "\r\n";
            $headers .= "Reply-To: " . "$email_id" . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";


            mail($to, $subject, $message1, $headers); //admin email


//****************************    Admin email ends    *************************

//****************************    Client email starts    *************************

            $to1 = $email_id;
            $subject1 = "$admin_site_name blog Update Successful";

            $client_sql_fetch = mysqli_query($conn, "SELECT * FROM " . COUNTRY_PREFIX . "mail  WHERE mail_id = 16 "); //User mail template fetch
            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

            $mail_template_client = $client_sql_fetch_row['mail_template'];

            $message2 = stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
            , '\' . $mobile_number . \'', '\' . $blog_name . \'', '\' . $blog_email . \'', '\' . $blog_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'', '\'.$webpage_full_link_with_login.\'', '\'.$admin_primary_email.\''),
                array('' . $admin_site_name . '', '' . $first_name . '', '' . $email_id . '', '' . $mobile_number . '', '' . $blog_name . '', '' . $blog_email . '', '' . $blog_mobile . '', '' . $admin_footer_copyright . '', '' . $admin_address . '', '' . $webpage_full_link . '', '' . $webpage_full_link_with_login . '', '' . $admin_primary_email . ''), $mail_template_client));


            $headers1 = "From: " . "$admin_email" . "\r\n";
            $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
            $headers1 .= "MIME-Version: 1.0\r\n";
            $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";


            mail($to1, $subject1, $message2, $headers1); //admin email

//****************************    client email ends    *************************

            if ($blog_type_id == 1) {

                $_SESSION['status_msg'] = "Your Blog has been Updated Successfully!!!";

                header('Location: admin-all-blogs.php');
                exit;
            } else {

                header("Location: paypal_pay.php?map_id=$blog_id&type_id=$blog_type_id");

                $_SESSION['status_msg'] = "Your Blog has been Updated Successfully!!!";

                exit;
            }

        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header("Location: admin-edit-blogs.php?row=$blog_id");
        }

        //    blog Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: admin-all-blogs.php');
}