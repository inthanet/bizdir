<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

$user_details_row = getUser($_SESSION['user_id']);

if (file_exists('config/general_user_authentication.php')) {
    include('config/general_user_authentication.php');
}

if (file_exists('config/listing_page_authentication.php')) {
    include('config/listing_page_authentication.php');
}

?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="login-reg">
                <div class="container">
                    <?php
                    $listing_codea = $_GET['row'];
                    $listings_a_row = getListing($listing_codea);

                    ?>
                    <form action="listing_trash.php" class="listing_form" id="listing_form"
                          name="listing_form" method="post" enctype="multipart/form-data">

                        <input type="hidden" id="listing_codea" value="<?php echo $listing_codea; ?>"
                               name="listing_codea" class="validate">
                        <input type="hidden" id="listing_id" value="<?php echo $listings_a_row['listing_id']; ?>"
                               name="listing_id" class="validate">
                        <input type="hidden" id="listing_code" value="<?php echo $listings_a_row['listing_code']; ?>"
                               name="listing_code" class="validate">
                        <input type="hidden" id="listing_is_delete"
                               value="<?php echo $listings_a_row['listing_is_delete']; ?>"
                               name="listing_is_delete" class="validate">
                        <input type="hidden" id="profile_image_old"
                               value="<?php echo $listings_a_row['profile_image']; ?>" name="profile_image_old"
                               class="validate">
                        <input type="hidden" id="cover_image_old"
                               value="<?php echo $listings_a_row['cover_image']; ?>" name="cover_image_old"
                               class="validate">
                        <input type="hidden" id="gallery_image_old"
                               value="<?php echo $listings_a_row['gallery_image']; ?>" name="gallery_image_old"
                               class="validate">
                        <input type="hidden" id="service_image_old"
                               value="<?php echo $listings_a_row['service_image']; ?>" name="service_image_old"
                               class="validate">
                        <input type="hidden" id="service_1_image_old"
                               value="<?php echo $listings_a_row['service_1_image']; ?>" name="service_1_image_old"
                               class="validate">
                        <div class="row">
                            <div class="login-main add-list posr">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['DELETE_LISTING']; ?></span>
                                <div class="log log-1">
                                    <div class="login">
                                        <h4><?php
                                            if (isset($_GET['path'])) {
                                                if ($_GET['path'] == "restore") {
                                                    echo "Restore";
                                                } elseif ($_GET['path'] == "trash") {
                                                    echo "Delete Permanently";
                                                }

                                            } else {
                                                echo "Delete";
                                            }
                                            ?><?php echo $BIZBOOK['LISTING_DETAILS']; ?></h4>
                                        <?php include "page_level_message.php"; ?>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input readonly="readonly" id="listing_name" name="listing_name"
                                                           type="text" required="required"
                                                           value="<?php echo $listings_a_row['listing_name']; ?>"
                                                           class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['LISTING_NAME_STAR']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input readonly="readonly" id="listing_mobile" name="listing_mobile"
                                                           type="text"
                                                           value="<?php echo $listings_a_row['listing_mobile']; ?>"
                                                           class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['PHONE_NUMBER']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input readonly="readonly" id="listing_email" name="listing_email"
                                                           type="text"
                                                           value="<?php echo $listings_a_row['listing_email']; ?>"
                                                           class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['EMAIL_ID']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input readonly="readonly" id="listing_website"
                                                           name="listing_website" type="text"
                                                           value="<?php echo $listings_a_row['listing_website']; ?>"
                                                           class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['WEBSITE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input readonly="readonly" type="text" id="listing_address"
                                                           name="listing_address" required="required"
                                                           value="<?php echo $listings_a_row['listing_address']; ?>"
                                                           class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['SHOP_ADDRESS']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->

                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select disabled="disabled" name="country_id" required="required"
                                                            class="form-control">
                                                        <option
                                                            value=""><?php echo $BIZBOOK['SELECT_YOUR_COUNTRY']; ?></option>
                                                        <?php
                                                        //Countries Query

                                                        foreach (getAllCountries() as $countries_row) {
                                                            ?>
                                                            <option <?php if ($listings_a_row['country_id'] == $countries_row['country_id']) {
                                                                echo "selected";
                                                            } ?>
                                                                value="<?php echo $countries_row['country_id']; ?>"><?php echo $countries_row['country_name']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input readonly="readonly" id="select-city" name="city_id"
                                                           value="<?php echo $cities_row['city_name']; ?>"
                                                           required="required" type="text" class="form-control"
                                                           placeholder="City name">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select disabled="disabled" name="category_id" id="category_id"
                                                            class="form-control">
                                                        <option
                                                            value=""><?php echo $BIZBOOK['SELECT_CATEGORY']; ?></option>
                                                        <?php
                                                        foreach (getAllCategories() as $categories_row) {
                                                            ?>
                                                            <option <?php if ($listings_a_row['category_id'] == $categories_row['category_id']) {
                                                                echo "selected";
                                                            } ?>
                                                                value="<?php echo $categories_row['category_id']; ?>"><?php echo $categories_row['category_name']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->

                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select disabled="disabled" name="sub_category_id"
                                                            id="sub_category_id"
                                                            class="form-control">
                                                        <option
                                                            value=""><?php echo $BIZBOOK['SELECT_SUB_CATEGORY']; ?></option>
                                                        <?php
                                                        foreach (getAllSubCategories() as $sub_categories_row) {
                                                            ?>
                                                            <option <?php if ($listings_a_row['sub_category_id'] == $sub_categories_row['sub_category_id']) {
                                                                echo "selected";
                                                            } ?>
                                                                value="<?php echo $sub_categories_row['sub_category_id']; ?>"><?php echo $sub_categories_row['sub_category_name']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                <textarea readonly="readonly" class="form-control"
                                                          id="listing_description"
                                                          name="listing_description"
                                                          placeholder="<?php echo $BIZBOOK['DETAILS_ABOUT_LISTING']; ?>"><?php echo $listings_a_row['listing_description']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="bor-box">
                                            <h3>Business hours</h3>
                                            <div class="row add-work-hrs">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Monday</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="mon_is_open" class="chosen-select form-control">
                                                            <option <?php if($listings_a_row['mon_is_open'] == 1){ echo 'selected'; } ?> value="1">Open</option>
                                                            <option <?php if($listings_a_row['mon_is_open'] == 0){ echo 'selected'; } ?> value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="mon_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['mon_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['mon_open_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['mon_open_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['mon_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="mon_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['mon_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['mon_close_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['mon_close_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['mon_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row add-work-hrs">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Tuesday</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="tue_is_open" class="chosen-select form-control">
                                                            <option <?php if($listings_a_row['tue_is_open'] == 1){ echo 'selected'; } ?> value="1">Open</option>
                                                            <option <?php if($listings_a_row['tue_is_open'] == 0){ echo 'selected'; } ?> value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="tue_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['tue_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['tue_open_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['tue_open_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['tue_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="tue_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['tue_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['tue_close_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['tue_close_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['tue_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row add-work-hrs">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Wednesday</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="wed_is_open" class="chosen-select form-control">
                                                            <option <?php if($listings_a_row['wed_is_open'] == 1){ echo 'selected'; } ?> value="1">Open</option>
                                                            <option <?php if($listings_a_row['wed_is_open'] == 0){ echo 'selected'; } ?> value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="wed_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['wed_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['wed_open_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['wed_open_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['wed_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="wed_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['wed_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['wed_close_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['wed_close_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['wed_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row add-work-hrs">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Thursday</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="thu_is_open" class="chosen-select form-control">
                                                            <option <?php if($listings_a_row['thu_is_open'] == 1){ echo 'selected'; } ?> value="1">Open</option>
                                                            <option <?php if($listings_a_row['thu_is_open'] == 0){ echo 'selected'; } ?> value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="thu_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['thu_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['thu_open_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['thu_open_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['thu_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="thu_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['thu_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['thu_close_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['thu_close_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['thu_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row add-work-hrs">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Friday</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="fri_is_open" class="chosen-select form-control">
                                                            <option <?php if($listings_a_row['fri_is_open'] == 1){ echo 'selected'; } ?> value="1">Open</option>
                                                            <option <?php if($listings_a_row['fri_is_open'] == 0){ echo 'selected'; } ?> value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="fri_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['fri_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['fri_open_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['fri_open_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['fri_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="fri_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['fri_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['fri_close_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['fri_close_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['fri_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row add-work-hrs">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Saturday</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="sat_is_open" class="chosen-select form-control">
                                                            <option <?php if($listings_a_row['sat_is_open'] == 1){ echo 'selected'; } ?> value="1">Open</option>
                                                            <option <?php if($listings_a_row['sat_is_open'] == 0){ echo 'selected'; } ?> value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="sat_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['sat_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['sat_open_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['sat_open_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['sat_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="sat_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['sat_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['sat_close_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['sat_close_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['sat_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row add-work-hrs">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Sunday</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="sun_is_open" class="chosen-select form-control">
                                                            <option <?php if($listings_a_row['sun_is_open'] == 1){ echo 'selected'; } ?> value="1">Open</option>
                                                            <option <?php if($listings_a_row['sun_is_open'] == 0){ echo 'selected'; } ?> value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="sun_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['sun_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['sun_open_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['sun_open_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['sun_open_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select disabled="disabled" name="sun_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['sun_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option <?php if($listings_a_row['sun_close_time'] == '12:00 pm'){ echo 'selected'; } ?> value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option <?php if($listings_a_row['sun_close_time'] == $i.':00 pm'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option <?php if($listings_a_row['sun_close_time'] == $i.':00 am'){ echo 'selected'; } ?> value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!--FILED END-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="login-main add-list add-list-ser">
                                <div class="log-bor">&nbsp;</div>
                                <span class="steps"><?php echo $BIZBOOK['STEP2']; ?></span>
                                <div class="log">
                                    <div class="login">

                                        <h4><?php echo $BIZBOOK['SERVICES_PROVIDE']; ?></h4>
                                        <ul>
                                            <?php
                                            $listings_a_row_service_id = $listings_a_row['service_id'];

                                            $serArray = explode(',', $listings_a_row_service_id);
                                            foreach ($serArray as $service_Array) {

                                                ?>
                                                <li>
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo $BIZBOOK['SERVICE_NAME']; ?>:</label>
                                                                <input type="text" readonly="readonly"
                                                                       name="service_id[]"
                                                                       value="<?php echo $service_Array; ?>"
                                                                       class="form-control"
                                                                       placeholder="<?php echo $BIZBOOK['SERVICE_NAME_PLACEHOLDER']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="login-main add-list">
                                <div class="log-bor">&nbsp;</div>
                                <span class="steps"><?php echo $BIZBOOK['STEP3']; ?></span>
                                <div class="log">
                                    <div class="login add-list-off">
                                        <h4><?php echo $BIZBOOK['SPECIAL_OFFERS']; ?></h4>
                                        <ul>
                                            <?php
                                            $listings_a_row_service_1_name = $listings_a_row['service_1_name'];
                                            $listings_a_row_service_1_price = $listings_a_row['service_1_price'];
                                            $listings_a_row_service_1_detail = $listings_a_row['service_1_detail'];

                                            $ser_1_name_Array = explode(',', $listings_a_row_service_1_name);
                                            $ser_1_price_Array = explode(',', $listings_a_row_service_1_price);
                                            $ser_1_detail_Array = explode(',', $listings_a_row_service_1_detail);

                                            $zipped = array_map(null, $ser_1_name_Array, $ser_1_price_Array, $ser_1_detail_Array);

                                            foreach ($zipped as $tuple) {
                                                $tuple[0]; // offer name
                                                $tuple[1]; // offer Price
                                                $tuple[2]; // offer Detail

                                                ?>
                                                <li>
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input readonly="readonly" type="text"
                                                                       class="form-control"
                                                                       value="<?php echo $tuple[0]; ?>"
                                                                       name="service_1_name[]"
                                                                       placeholder="<?php echo $BIZBOOK['OFFER_NAME']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input readonly="readonly" type="text"
                                                                       class="form-control"
                                                                       value="<?php echo $tuple[1]; ?>"
                                                                       name="service_1_price[]"
                                                                       placeholder="<?php echo $BIZBOOK['PRICE']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <textarea readonly="readonly" class="form-control"
                                                                      name="service_1_detail[]"
                                                                      placeholder="<?php echo $BIZBOOK['DETAILS_ABOUT_OFFER']; ?>"><?php echo $tuple[2]; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="login-main add-list">
                                <div class="log-bor">&nbsp;</div>
                                <span class="steps"><?php echo $BIZBOOK['STEP4']; ?></span>
                                <div class="log add-list-map">
                                    <div class="login add-list-map">

                                        <h4><?php echo $BIZBOOK['MAP_360_VIEW']; ?></h4>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea readonly="readonly" class="form-control" name="google_map"
                                                              placeholder="<?php echo $BIZBOOK['SHOP_LOCATION']; ?>"><?php echo $listings_a_row['google_map']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea readonly="readonly" class="form-control" name="360_view"
                                                              placeholder="<?php echo $BIZBOOK['360_VIEW']; ?>"><?php echo $listings_a_row['360_view']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="login-main add-list">
                                <div class="log-bor">&nbsp;</div>
                                <span class="steps"><?php echo $BIZBOOK['STEP5']; ?></span>
                                <div class="log">
                                    <div class="login add-lis-oth">

                                        <h4><?php echo $BIZBOOK['OTHER_INFORMATIONS']; ?></h4>
                                        <ul>
                                            <?php
                                            $listings_a_row_listing_info_question = $listings_a_row['listing_info_question'];
                                            $listings_a_row_listing_info_answer = $listings_a_row['listing_info_answer'];

                                            $listings_a_row_listing_info_question_Array = explode(',', $listings_a_row_listing_info_question);
                                            $listings_a_row_listing_info_answer_Array = explode(',', $listings_a_row_listing_info_answer);

                                            $zipped = array_map(null, $listings_a_row_listing_info_question_Array, $listings_a_row_listing_info_answer_Array);

                                            foreach ($zipped as $tuple) {
                                                $tuple[0]; // Info question
                                                $tuple[1]; // Info Answer

                                                ?>
                                                <li>
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input readonly="readonly" type="text"
                                                                       class="form-control"
                                                                       name="listing_info_question[]"
                                                                       value="<?php echo $tuple[0]; ?>"
                                                                       placeholder="<?php echo $BIZBOOK['OTHER_INFORMATIONS_PLACEHOLDER_LEFT']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <i class="material-icons">arrow_forward</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input readonly="readonly" type="text"
                                                                       class="form-control"
                                                                       name="listing_info_answer[]"
                                                                       value="<?php echo $tuple[1]; ?>"
                                                                       placeholder="<?php echo $BIZBOOK['OTHER_INFORMATIONS_PLACEHOLDER_RIGHT']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                </li>
                                                <?php
                                            }
                                            ?>


                                        </ul>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" name="listing_submit"
                                                        class="btn btn-primary"><?php
                                                    if (isset($_GET['path'])) {
                                                        if ($_GET['path'] == "restore") {
                                                            echo "Restore";
                                                        } elseif ($_GET['path'] == "trash") {
                                                            echo "Delete Permanently";
                                                        }

                                                    } else {
                                                        echo "Delete";
                                                    }
                                                    ?><?php echo $BIZBOOK['LISTING']; ?></button>
                                            </div>
                                            <div class="col-md-12">
                                                <a href="profile"
                                                   class="skip"><?php echo $BIZBOOK['GO_TO_USER_DASHBOARD']; ?> >></a>
                                            </div>
                                        </div>
                                        <!--FILED END-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript">var webpage_full_link = '<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url = '<?php echo $LOGIN_URL;?>';</script>
<script src="js/custom.js"></script>
</body>

</html>