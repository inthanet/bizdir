<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['plan_type_submit'])) {


        $path_id = $_POST['path_id'];
        $user_id = $_POST['user_id']; //Session User Code

        $user_plan = $_POST["user_plan"];
        $user_type = "Service provider";
        $user_status = "Active";
        $payment_status = "";

        $listing_user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM  " . TBL . "users where user_id='" . $user_id . "'";
        $rs = mysqli_query($conn, $sql);
        $user_row = mysqli_fetch_array($rs);

        $user_email_id = $user_row['email_id'];
        $first_name = $user_row['first_name'];

        $upqry = "UPDATE " . TBL . "users 
					  SET user_plan = '$user_plan',user_type = '$user_type', user_status = '$user_status', payment_status = '$payment_status', user_cdt = '$curDate'
					  WHERE user_id = $user_id";

        //echo $upqry; die();
        $upres = mysqli_query($conn, $upqry);

        if ($upres) {

            $_SESSION['status_msg'] = "User Plan has been Changed Successfully!!!";


            header('Location: admin-change-user-plan.php?path=2&row=' . $user_id);
            exit;

        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: admin-change-user-plan.php?path=2&row=' . $user_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: admin-change-user-plan.php?path=2&row=' . $user_id);
    exit;
}
?>