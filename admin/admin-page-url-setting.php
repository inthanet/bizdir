<?php
include "header.php";
?>

<?php if($admin_row['admin_setting_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst">Page URL Setting</span>
                <div class="ud-cen-s2 ud-pro-edit">
                    <h2>Page URL's</h2>
                    <?php include "../page_level_message.php"; ?>
                    <form name="page_url_setting_form" id="page_url_setting_form" method="post" enctype="multipart/form-data" action="update_page_url_setting.php">
                        <table class="responsive-table bordered">
                            <?php
                            $row_f = getAllFooter();
                            ?>
                            <input type="hidden" autocomplete="off" name="footer_id"
                                   value="<?php echo $row_f['footer_id']; ?>" id="footer_id" class="validate">

                            <tbody>
                            <tr>
                                <td>All Listing page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="all_listing_page_url" value="<?php echo $row_f['all_listing_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>All Products page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="all_products_page_url" value="<?php echo $row_f['all_products_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>All Jobs page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="all_jobs_page_url" value="<?php echo $row_f['all_jobs_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>All Service Experts page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="all_experts_page_url" value="<?php echo $row_f['all_experts_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>All News page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="all_news_page_url" value="<?php echo $row_f['all_news_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>User Profile page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="profile_page_url" value="<?php echo $row_f['profile_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Listing page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="listing_page_url" value="<?php echo $row_f['listing_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Job page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="job_page_url" value="<?php echo $row_f['job_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Service Expert page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="service_expert_page_url" value="<?php echo $row_f['service_expert_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>News page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="news_page_url" value="<?php echo $row_f['news_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Place page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="place_page_url" value="<?php echo $row_f['place_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Job Profile page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="job_profile_page_url" value="<?php echo $row_f['job_profile_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Job Profile Creation page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="job_profile_creation_page_url" value="<?php echo $row_f['job_profile_creation_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Event page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="event_page_url" value="<?php echo $row_f['event_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Blog page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="blog_page_url" value="<?php echo $row_f['blog_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Product page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="product_page_url" value="<?php echo $row_f['product_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Company page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="company_page_url" value="<?php echo $row_f['company_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Target Listing page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="target_listing_page_url" value="<?php echo $row_f['target_listing_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>E-Book page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="ebook_page_url" value="<?php echo $row_f['ebook_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Promotional page</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="promotion_page_url" value="<?php echo $row_f['promotion_page_url']; ?>" required="required" class="form-control" placeholder="all-listing">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button type="submit" name="page_url_setting_submit" class="db-pro-bot-btn">Submit Changes</button>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </form>
                    <div class="ud-notes">
                        <p><b>Notes:</b> Hi, Its important to update the same on .htaccess file manually what you have changed here.
                        </p><p>For example : </p>
                        <p>if All Listing page URl have been changed from '<b>all-listing</b>' to '<b>listing-all</b>'</p>
                        <p></p>
                        <p></p>
                        <p>1. Open .htaccess file</p>
                        <p>2. Find this line -> RewriteRule ^<b>all-listing</b>/([^/]*)$ %{ENV:BASE_PATH}all-listing.php?category=$1 [L]</p>
                        <p>3. Update this as -> RewriteRule ^<b>listing-all</b>/([^/]*)$ %{ENV:BASE_PATH}all-listing.php?category=$1 [L]</p>
                        <p>4. Save and close .htaccess file</p>
                    </div>
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
<script src="../js/select-opt.js"></script>
<script src="js/admin-custom.js"></script>

</body>

</html>