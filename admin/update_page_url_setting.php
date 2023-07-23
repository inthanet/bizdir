<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['page_url_setting_submit'])) {

        $footer_id = $_POST['footer_id'];

        $all_listing_page_url = $_POST['all_listing_page_url'];
        $all_products_page_url = $_POST['all_products_page_url'];
        $all_jobs_page_url = $_POST['all_jobs_page_url'];
        $all_experts_page_url = $_POST['all_experts_page_url'];
        $all_news_page_url = $_POST["all_news_page_url"];

        $profile_page_url = $_POST["profile_page_url"];
        $listing_page_url = $_POST["listing_page_url"];
        $job_page_url = $_POST["job_page_url"];
        $service_expert_page_url = $_POST["service_expert_page_url"];
        $news_page_url = $_POST["news_page_url"];

        $place_page_url = $_POST["place_page_url"];
        $job_profile_page_url = $_POST['job_profile_page_url'];
        $job_profile_creation_page_url = $_POST['job_profile_creation_page_url'];
        $event_page_url = $_POST["event_page_url"];
        $blog_page_url = $_POST["blog_page_url"];

        $product_page_url = $_POST["product_page_url"];
        $company_page_url = $_POST["company_page_url"];
        $target_listing_page_url = $_POST["target_listing_page_url"];
        $ebook_page_url = $_POST["ebook_page_url"];
        $promotion_page_url = $_POST["promotion_page_url"];


        $sql = mysqli_query($conn, "UPDATE  " . TBL . "footer SET  all_listing_page_url='" . $all_listing_page_url . "'
        ,all_products_page_url='" . $all_products_page_url . "', all_jobs_page_url='" . $all_jobs_page_url . "'
        , all_experts_page_url='" . $all_experts_page_url . "', all_news_page_url='" . $all_news_page_url . "'
        , profile_page_url='" . $profile_page_url . "', listing_page_url='" . $listing_page_url . "'
        , job_page_url='" . $job_page_url . "', service_expert_page_url='" . $service_expert_page_url . "'
        , news_page_url='" . $news_page_url . "', place_page_url='" . $place_page_url . "'
        , job_profile_page_url='" . $job_profile_page_url . "', job_profile_creation_page_url='" . $job_profile_creation_page_url . "'
        , event_page_url='" . $event_page_url . "', blog_page_url='" . $blog_page_url . "'
        , product_page_url='" . $product_page_url . "', company_page_url='" . $company_page_url . "'
        , target_listing_page_url='" . $target_listing_page_url . "', ebook_page_url='" . $ebook_page_url . "'
        , promotion_page_url='" . $promotion_page_url . "'
        where footer_id='" . $footer_id . "'");

       
        if ($sql) {

            $_SESSION['status_msg'] = "Setting Data has been Updated Successfully!!!";

            header('Location: admin-page-url-setting.php');
            exit;

        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: admin-page-url-setting.php');
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: admin-page-url-setting.php');
    exit;
}
?>