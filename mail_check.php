<?php
include "header.php";

if (isset($_POST) && !empty($_POST)){

    $from_email = $_POST["from_email"];
    $to_email = $_POST["to_email"];

    $subject1 = "RN53 - Test Mail";
    $message2 = "Hello, This is test mail.";

    $headers1 = "From: " . "$from_email" . "\r\n";
    $headers1 .= "Reply-To: " . "$from_email" . "\r\n";
    $headers1 .= "MIME-Version: 1.0\r\n";
    $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";


    $mail = mail($to_email, $subject1, $message2, $headers1);

    $_SESSION['status_msg'] = "Mail sent sucessfully!!!!";
    header('Location: mail_check.php');
    exit();
}

?>
<!-- START -->
<!--PRICING DETAILS-->
<section class="<?php if ($footer_row['admin_language'] == 2) {
    echo "lg-arb";
} ?> login-reg">
    <div class="container">
        <div class="row">
            <div class="login-main add-list">
                <div class="log-bor">&nbsp;</div>
                <span class="steps"><?php echo "Mail Check Portal"; ?></span>
                <div class="log">
                    <div class="login add-list-off">
                        <h4><?php echo "Welcome to RN53 Themes - Mail Check Portal"; ?></h4>
                        <?php include "page_level_message.php"; ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mail_check_form" id="mail_check_form" name="mail_check_form"
                              method="post" enctype="multipart/form-data">
                            <ul>
                                <li>
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="email" name="from_email" autocomplete="off"
                                                       required="required" class="form-control"
                                                       value="" placeholder="<?php echo "Enter Sender Mail Id"; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="email" name="to_email" autocomplete="off"
                                                       required="required" class="form-control"
                                                       value="" placeholder="<?php echo "Enter Receiver Mail Id"; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                </li>
                            </ul>
                            <!--FILED START-->
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="mail_submit"
                                            class="btn btn-primary"><?php echo "Send Test Mail"; ?></button>
                                </div>
                            </div>
                            <!--FILED END-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END PRICING DETAILS-->


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript">var webpage_full_link = '<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url = '<?php echo $LOGIN_URL;?>';</script>
<script src="js/custom.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>
</body>

</html>