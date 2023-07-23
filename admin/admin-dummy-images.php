<?php
include "header.php";
?>

<?php if($admin_row['admin_dummy_image_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst">Placeholder images</span>
                <div class="ud-cen-s2 ad-dum-ima hcat-cho">
                    <h2>Dummy Images</h2>
                    <?php include "../page_level_message.php"; ?>
                    <table class="responsive-table bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Image Position</th>
                            <th>Image</th>
                            <th>Change image</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $row_f = getAllFooter();

                        ?>
                        <form name="user_dummy_image_form" action="update_user_dummy_image.php" method="post"
                              enctype="multipart/form-data">
                            <input type="hidden" autocomplete="off" name="footer_id"
                                   value="<?php echo $row_f['footer_id']; ?>" id="footer_id" class="validate">
                            <input type="hidden" autocomplete="off" name="user_default_image_old"
                                   value="<?php echo $row_f['user_default_image']; ?>" id="user_default_image_old"
                                   class="validate">
                            <input type="hidden" autocomplete="off" name="listing_default_image_old"
                                   value="<?php echo $row_f['listing_default_image']; ?>" id="listing_default_image_old"
                                   class="validate">
                            <input type="hidden" autocomplete="off" name="job_default_image_old"
                                   value="<?php echo $row_f['job_default_image']; ?>" id="job_default_image_old"
                                   class="validate">
                            <input type="hidden" autocomplete="off" name="product_default_image_old"
                                   value="<?php echo $row_f['product_default_image']; ?>" id="product_default_image_old"
                                   class="validate">
                            <input type="hidden" autocomplete="off" name="coupon_default_image_old"
                                   value="<?php echo $row_f['coupon_default_image']; ?>" id="coupon_default_image_old"
                                   class="validate">
                            <input type="hidden" autocomplete="off" name="travel_default_image_old"
                                   value="<?php echo $row_f['travel_default_image']; ?>" id="travel_default_image_old"
                                   class="validate">
                            <input type="hidden" autocomplete="off" name="expert_default_image_old"
                                   value="<?php echo $row_f['expert_default_image']; ?>" id="expert_default_image_old"
                                   class="validate">
                            <input type="hidden" autocomplete="off" name="place_default_image_old"
                                   value="<?php echo $row_f['place_default_image']; ?>" id="place_default_image_old"
                                   class="validate">
                            <tr>
                                <td>1</td>
                                <td><b class="db-list-rat">User profile</b></td>
                                <td><img src="../images/user/<?php echo $row_f['user_default_image']; ?>" alt=""></td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="user_default_image" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><b class="db-list-rat">Listing page - Listing Module</b></td>
                                <td><img src="../images/listings/<?php echo $row_f['listing_default_image']; ?>" alt=""></td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="listing_default_image" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><b class="db-list-rat">Home page - Job Module</b></td>
                                <td><img src="../images/user/<?php echo $row_f['job_default_image']; ?>" alt=""></td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="job_default_image" class="form-control">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td><b class="db-list-rat">Home page - Product Module</b></td>
                                <td><img src="../images/user/<?php echo $row_f['product_default_image']; ?>" alt=""></td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="product_default_image" class="form-control">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td><b class="db-list-rat">Home page - Coupon Module</b></td>
                                <td><img src="../images/user/<?php echo $row_f['coupon_default_image']; ?>" alt=""></td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="coupon_default_image" class="form-control">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td><b class="db-list-rat">Home page - Travel Module</b></td>
                                <td><img src="../images/user/<?php echo $row_f['travel_default_image']; ?>" alt=""></td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="travel_default_image" class="form-control">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>6</td>
                                <td><b class="db-list-rat">Home page - Service Experts Module</b></td>
                                <td><img src="../images/user/<?php echo $row_f['expert_default_image']; ?>" alt=""></td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="expert_default_image" class="form-control">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>7</td>
                                <td><b class="db-list-rat">Home page - News Module</b></td>
                                <td><img src="../images/user/<?php echo $row_f['news_default_image']; ?>" alt=""></td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="news_default_image" class="form-control">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4">
                                    <button name="user_dummy_image_submit" type="submit" class="db-pro-bot-btn">Submit
                                        Changes
                                    </button>
                                </td>
                            </tr>
                        </form>

                        </tbody>
                    </table>
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