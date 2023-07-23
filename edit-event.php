<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

if (file_exists('config/general_user_authentication.php')) {
    include('config/general_user_authentication.php');
}

if (file_exists('config/event_page_authentication.php')) {
    include('config/event_page_authentication.php');
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
                <span class="steps"><?php echo $BIZBOOK['EDIT_EVENT']; ?></span>
                <div class="log">
                    <div class="login add-list-off">
                        <?php
                        $event_codea = $_GET['code'];
                        $events_a_row = getEvent($event_codea);

                        ?>
                        <h4><?php echo $BIZBOOK['EDIT_THIS_EVENT']; ?></h4>
                        <?php include "page_level_message.php"; ?>
                        <form action="event_update.php" class="event_edit_form" id="event_edit_form"
                              name="event_edit_form"
                              method="post" enctype="multipart/form-data">

                            <input type="hidden" id="event_id" value="<?php echo $events_a_row['event_id']; ?>"
                                   name="event_id" class="validate">
                            <input type="hidden" id="event_image_old"
                                   value="<?php echo $events_a_row['event_image']; ?>" name="event_image_old"
                                   class="validate">
                            <ul>
                                <li>
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="event_name" required="required"
                                                       class="form-control"
                                                       value="<?php echo $events_a_row['event_name']; ?>"
                                                       placeholder="<?php echo $BIZBOOK['EVENT_NAME']; ?>*">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="event_address" required="required"
                                                       class="form-control" id="event_address"
                                                       value="<?php echo $events_a_row['event_address']; ?>"
                                                       placeholder="<?php echo $BIZBOOK['ADDRESS']; ?>*">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="category_id"
                                                        id="category_id" class="chosen-select form-control">
                                                    <option value=""><?php echo $BIZBOOK['SELECT_CATEGORY']; ?></option>
                                                    <?php
                                                    foreach (getAllEventCategories() as $categories_row) {
                                                        ?>
                                                        <option <?php if ($events_a_row['category_id'] == $categories_row['category_id']) {
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select onChange="geteventCities(this.value);" name="country_id" required="required"
                                                        class="chosen-select form-control">
                                                    <option value=""><?php echo $BIZBOOK['SELECT_YOUR_COUNTRY']; ?></option>
                                                    <?php
                                                    //Countries Query
                                                    $admin_countries = $footer_row['admin_countries'];
                                                    $catArray = explode(',', $admin_countries);
                                                    foreach ($catArray as $cat_Array) {

                                                        foreach (getMultipleCountry($cat_Array) as $countries_row) {
                                                            ?>
                                                            <option <?php if ($events_a_row['country_id'] == $countries_row['country_id']) {
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

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select data-placeholder="<?php echo $BIZBOOK['SELECT_YOUR_CITY']; ?>"
                                                        name="city_id[]" id="city_id"
                                                        multiple required="required"
                                                        class="chosen-select form-control">
                                                    <?php
                                                    $cityArray = explode(',', $events_a_row['city_id']);
                                                    foreach ($cityArray as $cit_Array) {
                                                        ?>
                                                        <option <?php
                                                        echo "selected";

                                                        $city_row = getCity($cit_Array);

                                                        ?>
                                                                value="<?php echo $city_row['city_id']; ?>"><?php echo $city_row['city_name']; ?></option>
                                                        <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php
                                                $timestamp = strtotime($events_a_row['event_start_date']);
                                                $event_start_date = date('m/d/Y', $timestamp);
                                                ?>
                                                <input type="text" id="event_start_date" name="event_start_date"
                                                       required="required" class="form-control"
                                                       value="<?php echo $event_start_date; ?>"
                                                       placeholder="<?php echo $BIZBOOK['DATE']; ?>*">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="event_time" required="required"
                                                       class="form-control"
                                                       value="<?php echo $events_a_row['event_time']; ?>"
                                                       placeholder="<?php echo $BIZBOOK['TIME']; ?>*">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" required="required"
                                                          name="event_description" id="event_description"
                                                          placeholder="<?php echo $BIZBOOK['EVENT_DETAILS']; ?>"><?php echo $events_a_row['event_description'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name="event_map"
                                                          placeholder="<?php echo $BIZBOOK['GOOGLE_MAP_LOCATION']; ?>"><?php echo $events_a_row['event_map']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo $BIZBOOK['CHOOSE_BANNER_IMAGE']; ?></label>
                                                <div class="fil-img-uplo">
                                                    <span class="dumfil"><?php echo $BIZBOOK['UPLOAD_A_FILE'];  ?></span>
                                                    <input type="file" name="event_image" accept="image/*,.jpg,.jpeg,.png" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="event_contact_name" required="required"
                                                       class="form-control"
                                                       value="<?php echo $events_a_row['event_contact_name']; ?>"
                                                       placeholder="<?php echo $BIZBOOK['CONTACT_PERSON']; ?>*">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="event_mobile" required="required"
                                                       class="form-control"
                                                       value="<?php echo $events_a_row['event_mobile']; ?>"
                                                       placeholder="<?php echo $BIZBOOK['CONTACT_PHONE_NUMBER']; ?>*">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->

                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" name="event_email" required="required"
                                                       class="form-control"
                                                       value="<?php echo $events_a_row['event_email']; ?>"
                                                       placeholder="<?php echo $BIZBOOK['CONTACT_EMAIL_ID']; ?>*">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="event_website" class="form-control"
                                                       value="<?php echo $events_a_row['event_website']; ?>"
                                                       placeholder="<?php echo $BIZBOOK['EVENT_WEBSITE']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <div class="chbox">
                                                    <input type="checkbox" id="isenquiry" name="isenquiry"
                                                           <?php if ($events_a_row['isenquiry'] == 1){ ?>checked="" <?php } ?>>
                                                    <label
                                                        for="isenquiry"><?php echo $BIZBOOK['ENQUIRY_BOX_ENABLE']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                </li>
                            </ul>
                            <!--FILED START-->
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="event_submit"
                                            class="btn btn-primary"><?php echo $BIZBOOK['SAVE_CHANGES']; ?></button>
                                </div>
                                <div class="col-md-12">
                                    <a href="dashboard" class="skip"><?php echo $BIZBOOK['GO_TO_USER_DASHBOARD']; ?>
                                        >></a>
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
<script src="js/select-opt.js"></script>
<script src="admin/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('event_description');
</script>
<script>
    function geteventCities(val) {
        $.ajax({
            type: "POST",
            url: "city_process.php",
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
    <script src="js/google-geo-location-event-add.js">
     </script>
     <?php } ?>
</body>

</html>