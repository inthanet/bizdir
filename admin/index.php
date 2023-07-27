<?php
if (file_exists('config/info.php')) {
    include('config/info.php');
}

if (file_exists('classes/index.function.php')) {
    include('classes/index.function.php');
}
$footer_row = getAllFooter(); //Fetch Footer Data

if (!empty($_SESSION['admin_id'])) {
    if (isset($_GET['src'])) {
        header("location: " . $_GET['src']);
    } else {
        header("Location: profile.php");
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Admin Panel - <?php echo $footer_row['website_address']; ?></title>
    <!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#76cef1"/>
    <meta name="description" content="">
    <meta name="keyword" content="">
    <!--== FAV ICON(BROWSER TAB ICON) ==-->
    <link rel="shortcut icon" href="../images/fav.ico" type="image/x-icon">
    <!--== GOOGLE FONTS ==-->
    <link href="https://fonts.googleapis.com/css?family=Oswald:700|Source+Sans+Pro:300,400,600,700&display=swap"
          rel="stylesheet">
    <!--== CSS FILES ==-->
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="css/admin-style.css">
    <link rel="stylesheet" href="../css/fonts.css">
    
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
    <script src="../js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- START -->
<!--PRICING DETAILS-->
<section class="<?php if ($footer_row['admin_language'] == 2) {
    echo "lg-arb";
} ?> login-reg ad-login-reg">
    <div class="container">
        <div class="row">
            <div class="login-main">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst">Super Admin</span>
                <div class="log log-1">
                    <div class="login">
                        <div style="width:100%; text-align:center;">
                            <img src="<?php echo $footer_row['directory_country_flag'];?>" style="position: relative;top:-20px;">  
                        </div>
                        
                        <h4>Admin Login</h4>
                        <?php
                        if (isset($_SESSION['login_status_msg'])) {
                            include "../page_level_message.php";
                            unset($_SESSION['login_status_msg']);
                        }
                        ?>
                        <form name="directory_login" method="post" action="login_check.php">
                            <?php
                            if (isset($_GET['src'])) {
                                ?>
                                <input type="hidden" autocomplete="off" name="src" id="src"
                                       value="<?php echo $_GET['src'] ?>">
                                <?php
                            }
                            ?>
                            <div class="form-group">
                                <input type="text" name="admin_email" id="admin_email" class="form-control"
                                       placeholder="Enter email*" title="Invalid email address" value="" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="admin_password" id="admin_password" class="form-control"
                                       placeholder="Enter password*" value="" required>
                            </div>

                            <!-- <div style="width:100%; text-align:center;">
                                <div class="cf-turnstile" data-sitekey="0x4AAAAAAAH8J8a41-UqlWZm"></div>
                            </div>                             -->
                            
                            <button type="submit" value="submit" name="admin_submit" class="btn btn-primary">Sign in</button>
                        </form>
                    </div>
                </div>
                <div class="log log-3">
                    <div class="login">
                        <?php
                        if (isset($_SESSION['forgot_status_msg'])) {
                            include "../page_level_message.php";
                            unset($_SESSION['forgot_status_msg']);
                        }
                        ?>
                        <h4>Forgot Password</h4>
                        <form id="forget_form" name="forget_form" method="post" action="forgot_process.php">
                            <div class="form-group">
                                <input type="email" autocomplete="off" name="rec_email_id" class="form-control"
                                       placeholder="Enter Recovery Email Id*"
                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                       title="Invalid email address" required>
                            </div>
                            <button type="submit" name="forgot_submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>
                <div class="log-bot">
                    <ul>
                        <li>
                            <span class="ll-1">Login?</span>
                        </li>
                        <li>
                            <span class="ll-3">Forgot password?</span>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
    </div>
    <div style="width:100%; text-align:center;margin-top:50px;">
       <div class="cf-turnstile" data-sitekey="0x4AAAAAAAH8J8a41-UqlWZm" data-callback="javascriptCallback"></div>
    </div>        

</section>
<!--END PRICING DETAILS-->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/custom.js"></script>
<?php
if ($_GET['fp']) { ?>
    <script>
        $('.log-3').slideDown();
        $('.log-1, .log-2').slideUp();
    </script>
    <?php
}

?>
</body>

</html>