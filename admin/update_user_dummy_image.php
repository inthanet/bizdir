<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['user_dummy_image_submit'])) {


        $footer_id = $_POST['footer_id'];
        $user_default_image_old = $_POST['user_default_image_old'];
        $listing_default_image_old = $_POST['listing_default_image_old'];
        $job_default_image_old = $_POST['job_default_image_old'];
        $product_default_image_old = $_POST['product_default_image_old'];
        $coupon_default_image_old = $_POST['coupon_default_image_old'];
        $travel_default_image_old = $_POST['travel_default_image_old'];
        $expert_default_image_old = $_POST['expert_default_image_old'];
        $news_default_image_old = $_POST['news_default_image_old'];


        $_FILES['user_default_image']['name'];

        if (!empty($_FILES['user_default_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['user_default_image']['name'];
            $file_loc = $_FILES['user_default_image']['tmp_name'];
            $file_size = $_FILES['user_default_image']['size'];
            $file_type = $_FILES['user_default_image']['type'];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/user/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $event_image = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $event_image);
                $user_default_image = compressImage($event_image, $file_loc, $folder, $new_size);
            } else {
                $user_default_image = $user_default_image_old;
            }
        } else {
            $user_default_image = $user_default_image_old;
        }

        $_FILES['listing_default_image']['name'];

        if (!empty($_FILES['listing_default_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['listing_default_image']['name'];
            $file_loc = $_FILES['listing_default_image']['tmp_name'];
            $file_size = $_FILES['listing_default_image']['size'];
            $file_type = $_FILES['listing_default_image']['type'];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/listings/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $event_image = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $event_image);
                $listing_default_image = compressImage($event_image, $file_loc, $folder, $new_size);
            } else {
                $listing_default_image = $listing_default_image_old;
            }
        } else {
            $listing_default_image = $listing_default_image_old;
        }

        $_FILES['job_default_image']['name'];

        if (!empty($_FILES['job_default_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['job_default_image']['name'];
            $file_loc = $_FILES['job_default_image']['tmp_name'];
            $file_size = $_FILES['job_default_image']['size'];
            $file_type = $_FILES['job_default_image']['type'];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/user/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $event_image = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $event_image);
                $job_default_image = compressImage($event_image, $file_loc, $folder, $new_size);
            } else {
                $job_default_image = $job_default_image_old;
            }
        } else {
            $job_default_image = $job_default_image_old;
        }

        $_FILES['product_default_image']['name'];

        if (!empty($_FILES['product_default_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['product_default_image']['name'];
            $file_loc = $_FILES['product_default_image']['tmp_name'];
            $file_size = $_FILES['product_default_image']['size'];
            $file_type = $_FILES['product_default_image']['type'];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/user/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $event_image = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $event_image);
                $product_default_image = compressImage($event_image, $file_loc, $folder, $new_size);
            } else {
                $product_default_image = $product_default_image_old;
            }
        } else {
            $product_default_image = $product_default_image_old;
        }

        $_FILES['coupon_default_image']['name'];

        if (!empty($_FILES['coupon_default_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['coupon_default_image']['name'];
            $file_loc = $_FILES['coupon_default_image']['tmp_name'];
            $file_size = $_FILES['coupon_default_image']['size'];
            $file_type = $_FILES['coupon_default_image']['type'];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/user/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $event_image = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $event_image);
                $coupon_default_image = compressImage($event_image, $file_loc, $folder, $new_size);
            } else {
                $coupon_default_image = $coupon_default_image_old;
            }
        } else {
            $coupon_default_image = $coupon_default_image_old;
        }

        $_FILES['travel_default_image']['name'];

        if (!empty($_FILES['travel_default_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['travel_default_image']['name'];
            $file_loc = $_FILES['travel_default_image']['tmp_name'];
            $file_size = $_FILES['travel_default_image']['size'];
            $file_type = $_FILES['travel_default_image']['type'];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/user/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $event_image = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $event_image);
                $travel_default_image = compressImage($event_image, $file_loc, $folder, $new_size);
            } else {
                $travel_default_image = $travel_default_image_old;
            }
        } else {
            $travel_default_image = $travel_default_image_old;
        }

        $_FILES['expert_default_image']['name'];

        if (!empty($_FILES['expert_default_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['expert_default_image']['name'];
            $file_loc = $_FILES['expert_default_image']['tmp_name'];
            $file_size = $_FILES['expert_default_image']['size'];
            $file_type = $_FILES['expert_default_image']['type'];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/user/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $event_image = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $event_image);
                $expert_default_image = compressImage($event_image, $file_loc, $folder, $new_size);
            } else {
                $expert_default_image = $expert_default_image_old;
            }
        } else {
            $expert_default_image = $expert_default_image_old;
        }

        $_FILES['news_default_image']['name'];

        if (!empty($_FILES['news_default_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['news_default_image']['name'];
            $file_loc = $_FILES['news_default_image']['tmp_name'];
            $file_size = $_FILES['news_default_image']['size'];
            $file_type = $_FILES['news_default_image']['type'];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/user/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $event_image = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $event_image);
                $news_default_image = compressImage($event_image, $file_loc, $folder, $new_size);
            } else {
                $news_default_image = $news_default_image_old;
            }
        } else {
            $news_default_image = $news_default_image_old;
        }

        $sql = mysqli_query($conn, "UPDATE  " . TBL . "footer SET user_default_image='" . $user_default_image . "'
        ,listing_default_image='" . $listing_default_image . "'
        ,job_default_image='" . $job_default_image . "'
        ,product_default_image='" . $product_default_image . "'
        ,coupon_default_image='" . $coupon_default_image . "'
        ,travel_default_image='" . $travel_default_image . "'
        ,expert_default_image='" . $expert_default_image . "'
        ,news_default_image='" . $news_default_image . "'
     where footer_id='" . $footer_id . "'");

        if ($sql) {

            $_SESSION['status_msg'] = "Admin Default image has been Updated Successfully!!!";


            header('Location: admin-dummy-images.php');
            exit;

        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: admin-dummy-images.php');
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: admin-dummy-images.php');
    exit;
}
?>