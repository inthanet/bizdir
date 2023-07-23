<?php
include "header.php";
?>

<?php if($footer_row['admin_event_show'] !=1 || $admin_row['admin_event_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <section class="login-reg">
                <div class="container">
                    <div class="row">
                        <div class="login-main add-list posr">
                            <div class="log-bor">&nbsp;</div>
                            <span class="udb-inst">Edit event</span>
                            <div class="log log-1">
                                <div class="login">
                                    <h4>Edit this Event</h4>
                                    <?php include "../page_level_message.php"; ?>
                                    <?php
                                    $event_codea = $_GET['row'];
                                    $events_a_row = getEvent($event_codea);

                                    ?>
                                    <form action="update_event.php" class="event_edit_form" id="event_edit_form" name="event_edit_form"
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
                                                            <select name="user_id" required="required" class="form-control" id="user_id">
                                                                <option value="">Choose a user</option>
                                                                <?php
                                                                foreach (getAllUser() as $row) {
                                                                    ?>
                                                                    <option <?php if($events_a_row['user_id']== $row['user_id']){ echo "selected"; } ?>
                                                                        value="<?php echo $row['user_id']; ?>"><?php echo $row['first_name']; ?></option>
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
                                                            <input type="text" name="event_name" required="required" class="form-control"
                                                                   value="<?php echo $events_a_row['event_name']; ?>" placeholder="Event name *">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" name="event_address" required="required" class="form-control" id="event_address"
                                                                   value="<?php echo $events_a_row['event_address']; ?>"  placeholder="Address *">
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
                                                                <option value="">Select Category</option>
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
                                                                <option value=""><?php echo "Select your Country"; ?></option>
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
                                                            <select data-placeholder="<?php echo "Select Your City"; ?>"
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
                                                            <input type="text" id="event_start_date" name="event_start_date" required="required" class="form-control"
                                                                   value="<?php echo $event_start_date; ?>" placeholder="Date *">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="event_time" required="required" class="form-control"
                                                                   value="<?php echo $events_a_row['event_time']; ?>" placeholder="Time *">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control" required="required" id="event_description" name="event_description"
                                                                      placeholder="Event details"><?php echo $events_a_row['event_description']?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control" name="event_map"
                                                                      placeholder="Google map location"><?php echo $events_a_row['event_map']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Choose banner image</label>
                                                            <input type="file" name="event_image" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="event_contact_name" required="required" class="form-control"
                                                                   value="<?php echo $events_a_row['event_contact_name']; ?>" placeholder="Contact person *">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="event_mobile" required="required" class="form-control"
                                                                   value="<?php echo $events_a_row['event_mobile']; ?>" placeholder="Contact phone number *">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->

                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="email" name="event_email" required="required" class="form-control"
                                                                   value="<?php echo $events_a_row['event_email']; ?>" placeholder="Contact Email Id *">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="event_website" class="form-control"
                                                                   value="<?php echo $events_a_row['event_website']; ?>" placeholder="Event Website">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->

                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div>
                                                            <div class="chbox">
                                                                <input type="checkbox" id="isenquiry" name="isenquiry" <?php if($events_a_row['isenquiry'] == 1){ ?> checked="" <?php }?>>
                                                                <label for="isenquiry">Enquiry or Registration form
                                                                    enable</label>
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
                                                <button type="submit" name="event_submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                    </form>
                                    <div class="col-md-12">
                                        <a href="profile.php" class="skip">Go to user dashboard
                                            >></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

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
<script src="js/admin-custom.js"></script> 
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script src="../js/select-opt.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('event_description');
</script>
<script>
    function geteventCities(val) {
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
    <script src="../js/google-geo-location-event-add.js">
     </script>
     <?php } ?>
</body>

</html>