<?php
include "header.php";
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="login-reg">
                <div class="container">
                    <form action="insert_listing.php" class="listing_form" id="listing_form"
                          name="listing_form" method="post" enctype="multipart/form-data">
                          <?php if ($footer_row['admin_google_paid_geo_location'] == 1) { ?>
                                <input id="geo_country" value="" name="geo_country" type="hidden" class="form-control">
                                <input id="geo_city" value="" name="geo_city" type="hidden" class="form-control">
                                <?php } ?>
                        <div class="row">
                            <div class="login-main add-list posr">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst">step 1</span>
                                <div class="log log-1">
                                    <div class="login">
                                        <h4>Listing Details</h4>
                                        <?php include "../page_level_message.php"; ?>

                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select name="user_code" id="user_code" class="form-control"
                                                            required="required">
                                                        <option value="" disabled selected>User Name</option>
                                                        <?php
                                                        foreach (getAllUser() as $ad_users_row) {
                                                            ?>
                                                            <option
                                                                value="<?php echo $ad_users_row['user_code']; ?>"><?php echo $ad_users_row['first_name']; ?></option>
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
                                                    <input id="listing_name" name="listing_name" type="text"
                                                           required="required" class="form-control"
                                                           placeholder="Listing name *">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="listing_mobile" class="form-control"
                                                           placeholder="Phone number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="listing_email" class="form-control"
                                                           placeholder="Email id">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="listing_whatsapp" class="form-control"
                                                           placeholder="Whatsapp Number">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="listing_website" class="form-control"
                                                           placeholder="Webiste(www.rn53themes.net)">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" id="listing_address" name="listing_address" required="required" class="form-control"
                                                           placeholder="Shop address">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->

                                        <!--FILED START-->
                                        <!-- <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="listing_lat" class="form-control"
                                                           placeholder="Latitude i.e 40.730610">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="listing_lng" class="form-control"
                                                           placeholder="Longitude i.e -73.935242">
                                                </div>
                                            </div>
                                        </div> -->
                                        <!--FILED END-->
                                        <?php if ($footer_row['admin_google_paid_geo_location'] == 0) { ?>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select onChange="getCities(this.value);" name="country_id" required="required"
                                                            class="form-control">
                                                        <option value="">Select your Country</option>
                                                        <?php
                                                        //Countries Query
                                                        $admin_countries = $footer_row['admin_countries'];
                                                        $catArray = explode(',', $admin_countries);
                                                        foreach($catArray as $cat_Array) {

                                                            foreach (getMultipleCountry($cat_Array) as $countries_row) {
                                                                ?>
                                                                <option <?php if ($_SESSION['country_id'] == $countries_row['country_id']) {
                                                                    echo "selected";
                                                                } ?>
                                                                    value="<?php echo $countries_row['country_id']; ?>"><?php echo $countries_row['country_name']; ?></option>
                                                                <?php
                                                            }
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
                                                    <select data-placeholder="Select your Cities" name="city_id[]" id="city_id" multiple required="required"
                                                            class="chosen-select form-control">
                                                        <option value="">Select your Cities</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <?php } ?>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select onChange="getSubCategory(this.value);" name="category_id" id="category_id" class="form-control">
                                                        <option value="">Select Category</option>
                                                        <?php
                                                        foreach (getAllCategories() as $categories_row) {
                                                            ?>
                                                            <option
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
                                                    <select  data-placeholder="Select Sub Category" name="sub_category_id[]" id="sub_category_id" multiple class="chosen-select form-control">
                                                        <option value="">Select Sub Category</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" id="listing_description"
                                                              name="listing_description"
                                                              placeholder="Details about your listing"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Choose profile image</label>
                                                    <input type="file" name="profile_image" class="form-control">
                                                </div>
                                            </div>
<!--                                            <div class="col-md-6">-->
<!--                                                <div class="form-group">-->
<!--                                                    <label>Choose cover image</label>-->
<!--                                                    <input type="file" name="cover_image" class="form-control">-->
<!--                                                </div>-->
<!--                                            </div>-->
                                        </div>
                                        <!--FILED END-->

                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                        <textarea class="form-control" id="service_locations"
                                                  name="service_locations"
                                                  placeholder="Enter your service locations... &#10;(i.e) London, Dallas, Wall Street, Opera House"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->

<!--                                        <div class="bor-box">-->
                                            <h3>Business hours</h3>
                                            <div class="row add-work-hrs">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Monday</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="mon_is_open" class="chosen-select form-control">
                                                            <option selected="selected" value="1">Open</option>
                                                            <option value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="mon_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="mon_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
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
                                                        <select name="tue_is_open" class="chosen-select form-control">
                                                            <option selected="selected" value="1">Open</option>
                                                            <option value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="tue_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="tue_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
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
                                                        <select name="wed_is_open" class="chosen-select form-control">
                                                            <option selected="selected" value="1">Open</option>
                                                            <option value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="wed_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="wed_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
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
                                                        <select name="thu_is_open" class="chosen-select form-control">
                                                            <option selected="selected" value="1">Open</option>
                                                            <option value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="thu_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="thu_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
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
                                                        <select name="fri_is_open" class="chosen-select form-control">
                                                            <option selected="selected" value="1">Open</option>
                                                            <option value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="fri_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="fri_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
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
                                                        <select name="sat_is_open" class="chosen-select form-control">
                                                            <option selected="selected" value="1">Open</option>
                                                            <option value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="sat_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="sat_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
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
                                                        <select name="sun_is_open" class="chosen-select form-control">
                                                            <option selected="selected" value="1">Open</option>
                                                            <option value="0">Close</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="sun_open_time" class="chosen-select form-control">
                                                            <option>Open time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="sun_close_time" class="chosen-select form-control">
                                                            <option>Close time</option>
                                                            <?php
                                                            for ($i =6; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                            <option value="12:00 pm">12:00 pm</option>
                                                            <?php
                                                            for ($i =1; $i <= 11; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 pm"><?php echo $i; ?>:00 pm</option>
                                                            <?php } ?>
                                                            <?php
                                                            for ($i =1; $i <= 5; $i++){?>
                                                                <option value="<?php echo $i; ?>:00 am"><?php echo $i; ?>:00 am</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

<!--                                        </div>-->
                                        <!--FILED END-->

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="login-main add-list add-list-ser">
                                <div class="log-bor">&nbsp;</div>
                                <span class="steps">Step 2</span>
                                <div class="log">
                                    <div class="login">

                                        <h4>Services provide</h4>
                                        <span class="add-list-add-btn lis-ser-add-btn" title="add new offer">+</span>
                                        <span class="add-list-rem-btn lis-ser-rem-btn" title="remove offer">-</span>
                                            <ul>
                                                <li>
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Service name:</label>
                                                                <input type="text" name="service_id[]"
                                                                       class="form-control"
                                                                       placeholder="Ex: Plumbile">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Choose profile image</label>
                                                                <input type="file" name="service_image[]"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                </li>
                                                <li>
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Service name:</label>
                                                                <input type="text" name="service_id[]"
                                                                       class="form-control"
                                                                       placeholder="Ex: bike service">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Choose profile image</label>
                                                                <input type="file" name="service_image[]"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                </li>
                                            </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="login-main add-list">
                                <div class="log-bor">&nbsp;</div>
                                <span class="steps">Step 3</span>
                                <div class="log">
                                    <div class="login">

                                        <h4>Special offers</h4>
                                        <div class="add-list-off">
                                        <span class="add-list-add-btn lis-add-off" title="add new offer">+</span>
                                        <span class="add-list-rem-btn lis-add-rem" title="remove offer">-</span>

                                        <ul>
                                            <li>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="service_1_name[]"
                                                                   class="form-control"
                                                                   placeholder="Offer name *">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="service_1_price[]"
                                                                   class="form-control" onkeypress="return isNumber(event)"
                                                                   placeholder="Price">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                        <textarea class="form-control" name="service_1_detail[]"
                                                                  placeholder="Details about this offer"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Choose offer image</label>
                                                            <input type="file" name="service_1_image[]"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" name="service_1_view_more[]"
                                                                   class="form-control"  placeholder="View More Link">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                            </li>
                                        </ul>
                                        </div>
                                        <ul>
                                            <hr>
                                            <li>
                                                <!--- START -->
                                                <div class="list-show-oth-modu">
                                                    <h4>Products</h4>
                                                    <select name="listing_products[]" multiple="multiple" class="chosen-select form-control"  data-placeholder="Select Products">
                                                        <?php
                                                        foreach (getAllProduct() as $row) {
                                                            ?>
                                                            <option
                                                                    value="<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!--- END -->
                                            </li>
                                            <hr>
                                            <li>
                                                <!--- START -->
                                                <div class="list-show-oth-modu">
                                                    <h4>Events</h4>
                                                    <select name="listing_events[]" multiple="multiple" class="chosen-select form-control"  data-placeholder="Select Events">
                                                        <?php
                                                        foreach (getAllEvents() as $row) {
                                                            ?>
                                                            <option
                                                                    value="<?php echo $row['event_id']; ?>"><?php echo $row['event_name']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!--- END -->
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="login-main add-list">
                                <div class="log-bor">&nbsp;</div>
                                <span class="steps">Step 4</span>
                                <div class="log add-list-map">
                                    <div class="login add-list-map">
                                        <h4>Video Gallery</h4>
                                        <ul>
                                            <span class="add-list-add-btn lis-add-oadvideo" title="add new video">+</span>
                                            <span class="add-list-rem-btn lis-add-orevideo" title="remove video">-</span>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                 <textarea id="listing_video" name="listing_video[]"
                                                           class="form-control"
                                                           placeholder="Paste Your Youtube Url here"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                        </ul>
                                        <h4>Map</h4>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                <textarea class="form-control" name="google_map"
                                                          placeholder="Shop location"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-md-12">-->
<!--                                                <div class="form-group">-->
<!--                                                <textarea class="form-control" name="360_view"-->
<!--                                                          placeholder="360 view"></textarea>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
                                        <!--FILED END-->

                                        <h4 class="pt30">Photo gallery</h4>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file" name="gallery_image[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file" name="gallery_image[]" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file" name="gallery_image[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file" name="gallery_image[]" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file" name="gallery_image[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file" name="gallery_image[]" class="form-control">
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
                                <span class="steps">Step 5</span>
                                <div class="log">
                                    <div class="login add-lis-oth">

                                        <h4>Other informations</h4>
                                        <span class="add-list-add-btn lis-add-oad" title="add new offer">+</span>
                                        <span class="add-list-rem-btn lis-add-ore" title="remove offer">-</span>

                                        <ul>
                                            <li>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <input type="text" name="listing_info_question[]"
                                                                   class="form-control" placeholder="Experience">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <i class="material-icons">arrow_forward</i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <input type="text" name="listing_info_answer[]"
                                                                   class="form-control" placeholder="20 years">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                            </li>
                                            <!--FILED START-->
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <input type="text" name="listing_info_question[]"
                                                                   class="form-control" placeholder="Parking">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <i class="material-icons">arrow_forward</i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <input type="text" name="listing_info_answer[]"
                                                                   class="form-control" placeholder="yes">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--FILED END-->
                                            <!--FILED START-->
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <input type="text" name="listing_info_question[]"
                                                                   class="form-control" placeholder="Smoking">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <i class="material-icons">arrow_forward</i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <input type="text" name="listing_info_answer[]"
                                                                   class="form-control" placeholder="yes">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--FILED END-->
                                            <!--FILED START-->
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <input type="text" name="listing_info_question[]"
                                                                   class="form-control" placeholder="Take Out">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <i class="material-icons">arrow_forward</i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <input type="text" name="listing_info_answer[]"
                                                                   class="form-control" placeholder="yes">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--FILED END-->

                                        </ul>
                                        <!--FILED START-->
                                        <div class="row">
                                            <!--                                        <div class="col-md-6">-->
                                            <!--                                            <button type="submit" class="btn btn-primary">Previous</button>-->
                                            <!--                                        </div>-->
                                            <div class="col-md-12">
                                                <button type="submit" name="listing_submit" class="btn btn-primary">
                                                    Submit
                                                    Listing
                                                </button>
                                            </div>
                                            <div class="col-md-12">
                                                <a href="profile.php" class="skip">Go to Dashboard >></a>
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
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/select-opt.js"></script>
<script src="js/admin-custom.js"></script>
<script>
    $("document").ready(function(){
        $(".add-work-hrs .chosen-select").chosen().change(function() {
            var _tt = $(this).trigger("chosen:updated").val();
            if(_tt === "0"){
                //$(this).closet("chosen-select").prop('disabled', true).trigger("liszt:updated");
                $(this).parent().parent(".col-md-3").siblings(".col-md-3").find(".chosen-select").prop('disabled', true);
                $(this).parent().parent(".col-md-3").siblings(".col-md-3").find(".chosen-container").hide();
                $(this).parent().parent(".col-md-3").siblings(".col-md-3").find(".chosen-container").hide();
                $(this).parent().parent(".col-md-3").siblings(".col-md-3").find(".chosen-select").show();
                $(this).parent().parent(".col-md-3").siblings(".col-md-3").find(".chosen-select").val("");
            }
            else{
                //$(this).closet("chosen-select").prop('disabled', true).trigger("liszt:updated");
                $(this).parent().parent(".col-md-3").siblings(".col-md-3").find(".chosen-select").prop('disabled', false);
                $(this).parent().parent(".col-md-3").siblings(".col-md-3").find(".chosen-container").show();
                $(this).parent().parent(".col-md-3").siblings(".col-md-3").find(".chosen-select").hide();
            }
        })
    })
    function getSubCategory(val) {
        $.ajax({
            type: "POST",
            url: "../sub_category_process.php",
            data: 'category_id=' + val,
            success: function (data) {
                $("#sub_category_id").html(data);
                $('#sub_category_id').trigger("chosen:updated");
            }
        });
    }
</script>
<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('listing_description');
</script>
<script>
    function getCities(val) {
        $.ajax({
            type: "POST",
            url: "../city_process.php",
            data: 'country_id=' + val,
            success: function (data) {
                $("#city_id").html(data);
                $('#city_id').trigger("chosen:updated");
            }
        });
    }
</script>
<?php if ($footer_row['admin_google_paid_geo_location'] == 1) { ?>
<script
      src="https://maps.googleapis.com/maps/api/js?key=<?php echo $footer_row['admin_geo_map_api']; ?>&callback=initAutocomplete&libraries=places&v=weekly"
      defer
    ></script>
    <script src="../js/google-geo-location-listing-add.js">
     </script>
     <?php } ?>
</body>

</html>