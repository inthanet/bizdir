<?php
include "header.php";
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst">Change user plan Details</span>
                <div class="ud-cen-s2 ud-pro-edit">
                    <h2>Change user plan</h2>
                    <?php include "../page_level_message.php"; ?>
                    <?php
                    $path_id = $_GET['path'];
                    $user_id = $_GET['row'];
                    $user_details_row = getUser($user_id);

                    $user_plan = $user_details_row['user_plan']; //Fetch of Logged In user Plan

                    $user_plan_type = getPlanType($user_plan); //Fetch Logged In User Plan details and data

                    //To calculate the expiry date from user created date starts

                    $start_date_timestamp = strtotime($user_details_row['user_cdt']);
                    $plan_type_duration = $user_plan_type['plan_type_duration'];

                    $expiry_date_timestamp = strtotime("+$plan_type_duration months", $start_date_timestamp);

                    $expiry_date = date("Y-m-d h:i:s", $expiry_date_timestamp);

                    //To calculate the expiry date from user created date ends

                    ?>
                    <form name="plan_change_form" id="plan_change_form" method="post" enctype="multipart/form-data"
                          action="update_plan_change.php">

                        <input type="hidden" autocomplete="off" name="trap_box" id="trap_box" class="validate">
                        <input type="hidden" autocomplete="off" name="user_id"
                               value="<?php echo $user_details_row['user_id']; ?>" id="user_id" class="validate">
                        <input type="hidden" autocomplete="off" name="path_id" value="<?php echo $path_id; ?>"
                               id="path_id" class="validate">

                        <input type="hidden" autocomplete="off" name="mode_path" value="XeBaCk_MoDeX_PATHXHU"
                               id="mode_path" class="validate">
                        <input type="hidden" autocomplete="off" name="password_old" value="<?php echo $user_details_row['password']; ?>"
                               id="password_old" class="validate">

                        <input type="hidden" value="<?php echo $user_details_row['profile_image']; ?>"
                               autocomplete="off" name="profile_image_old" id="profile_image_old" required
                               class="validate">

                        <table class="responsive-table bordered">
                            <tbody>
                            <tr>
                                <td>Name</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $user_details_row['first_name']; ?>"
                                               required="required" readonly="readonly" autocomplete="off" name="first_name"
                                               id="first_name" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Current Plan</td>
                                <td>
                                    <div class="form-group">
                                        <input type="email" readonly="readonly"
                                               value="<?php if ($user_details_row['user_type'] == "Service provider") {
                                                   echo $user_plan_type['plan_type_name'];
                                               } else {
                                                   echo "General User";
                                               } ?>"
                                               required="required" autocomplete="off" name="email_id" id="email_id"
                                               class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Expiry Date</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" autocomplete="off" readonly="readonly"
                                               value="<?php if ($user_details_row['user_type'] == "Service provider") {
                                                   echo dateFormatconverter($expiry_date);
                                               } else {
                                                   echo "Unlimited";
                                               } ?>" name="password" placeholder="Change Password"
                                               id="password" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>New Plan </br></br> <a target="_blank" href="../pricing-details">Plan Details - Click Here</td>
                                <td>
                                    <div class="form-group">
                                        <select name="user_plan" required="required" id="user_plan" class="form-control">
                                            <option value=""
                                                    selected="selected"><?php echo "Choose Your Plan"; ?></option>
                                            <?php
                                            if ($user_details_row['user_type'] == "Service provider") {
                                                $plan_type_id = $user_plan_type['plan_type_id'];
                                            } else {
                                                $plan_type_id = 1;
                                            }
                                            $plan_type = "SELECT *
										FROM " . TBL . "plan_type WHERE plan_type_status='Active'

										ORDER BY plan_type_id ASC";


                                            $rs_plan_type = mysqli_query($conn, $plan_type);

                                            $si = 1;
                                            while ($plan_type_row = mysqli_fetch_array($rs_plan_type)) {

                                                if ($plan_type_row['plan_type_duration'] >= 7) {
                                                    $date_text = "/year";
                                                } else {
                                                    $date_text = "/month";
                                                }
                                                ?>
                                                <option
                                                    value="<?php echo $plan_type_row['plan_type_id']; ?>"><?php echo $plan_type_row['plan_type_name'];
                                                    if ($plan_type_row['plan_type_price'] != 0) {
                                                        echo ' - '; if($footer_row['currency_symbol_pos']== 1){ echo $footer_row['currency_symbol']; } echo '' . $plan_type_row['plan_type_price']; if($footer_row['currency_symbol_pos']== 2){ echo $footer_row['currency_symbol']; } echo $date_text;
                                                    } ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="submit" name="plan_type_submit" class="db-pro-bot-btn">Update
                                        User Plan
                                    </button>
                                </td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>


            </div>

        </div>
    </div>
</section>
<!-- END -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="js/admin-custom.js"></script> <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>