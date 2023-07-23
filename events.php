<?php
include "header.php";

if ($footer_row['admin_event_show'] != 1) {
    header("Location: " . $webpage_full_link . "dashboard");
}

?>
<?php
if (isset($_GET['category']) && !empty($_REQUEST['category'])) {


    $category_search_slug = str_replace('-', ' ', $_GET['category']);

    $cat_search_row = getSlugEventCategory($category_search_slug);  //Fetch Category Id using category name

    $category_id = $cat_search_row['category_id'];

    $category_slug = $cat_search_row['category_slug'];

    $category_search_name = $cat_search_row['category_name'];

    $category_search_query = "AND FIND_IN_SET($category_id, T1.category_id)";

}

//Event Location Check starts
if (isset($_REQUEST['city']) && !empty($_REQUEST['city'])) {

    $get_city = $_REQUEST['city'];
    $city1 = str_replace('-', ' ', $get_city);

    $city_search_row = getCityName($city1);  //Fetch City Id using City name

    $get_city1 = $city_search_row['city_id'];

    if (strstr($get_city1, ',')) {
        $data56 = explode(',', $get_city1);
        $sub_cat_array2 = array();
        foreach ($data56 as $c) {
            $sub_cat_array2[] = "FIND_IN_SET($c,T1.city_id)";

        }
        $events_location_search_query = 'AND (' . implode(' OR ', $sub_cat_array2) . ')';
    } else {
        $events_location_search_query = 'AND (FIND_IN_SET(' . $get_city1 . ',T1.city_id))';

    }
}

//Calendar order starts
if (isset($_REQUEST['calendar-date']) && !empty($_REQUEST['calendar-date'])  && $_REQUEST['calendar-date'] !== "[object Object]") {

    $get_calendar_date = $_REQUEST['calendar-date'];

    if ($get_calendar_date != '') {
        $phpdate = strtotime($get_calendar_date);
        $new_date = date("Y-m-d", $phpdate);

        $event_sort_by_query = 'AND T1.event_start_date = "'.$new_date.'"';
    }

}else {

//Event order starts
    if (isset($_REQUEST['sort_by']) && !empty($_REQUEST['sort_by'])) {

        $get_sort_by = $_REQUEST['sort_by'];

        if ($get_sort_by != '') {

            if ($get_sort_by == 'upcoming') {
                $event_sort_by_query = 'AND T1.event_start_date >= NOW()';

            } elseif ($get_sort_by == 'today') {
                $event_sort_by_query = 'AND T1.event_start_date = CURDATE()';

            } elseif ($get_sort_by == 'finished') {
                $event_sort_by_query = 'AND T1.event_start_date <= NOW()';
            }
        }

    }
//    else {
//        $get_sort_by = 'upcoming';
//        $event_sort_by_query = 'AND T1.event_start_date >= NOW()';
//    }
}

//$event_sort_by_search_query = 'GROUP BY T2.event_id';
//$event_start_search_query = ', T2.event_id, COUNT(T2.event_id) as top';
//$event_end_search_query = "INNER JOIN " . TBL . "page_views AS T2 ON T1.event_id = T2.event_id";

?>

<!-- START -->
<section class="news-hom-ban-sli pg-eve-ban">
    <div class="news-hom-ban-sli-inn">
        <ul class="multiple-items1">
            <?php
            $si = 1;
            foreach (getAllTopViewsPremiumActiveEvents() as $top_event_row) {

                $top_user_id = $top_event_row['user_id'];

                $top_user_details_row = getUser($top_user_id);

                ?>
                <li>
                    <div class="news-hban-box">
                        <div class="im">
                            <img loading="lazy" src="images/events/<?php echo $top_event_row['event_image']; ?>" alt="">
                        </div>
                        <div class="txt">
                            <span class="news-cate"><?php echo $BIZBOOK['EVENT_TOP_EVENTS']; ?></span><br>
                            <span class="eve-date-sli"><?php echo dateDayFormatconverter($top_event_row['event_start_date']); ?>
                                <b><?php echo dateMonthFormatconverter($top_event_row['event_start_date']); ?></b></span>
                            <h2><?php echo $top_event_row['event_name']; ?></h2>
                        </div>
                        <a href="<?php echo $EVENT_URL . urlModifier($top_event_row['event_slug']); ?>"
                           class="fclick"></a>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</section>
<!--END-->

<!-- START -->
<section class="<?php if ($footer_row['admin_language'] == 2) {
    echo "lg-arb";
} ?> event-body">
    <div class="container">
        <div class="blog-head-inn">
            <h1><?php echo $BIZBOOK['EVENTS']; ?></h1>
            <p><?php echo $BIZBOOK['EVENT_HEAD_MESSAGE']; ?></p>
            <div class="ban-search">
                <form>
                    <ul>
                        <li class="sr-sea">
                            <input type="text" id="event-search" class="autocomplete"
                                   placeholder="<?php echo $BIZBOOK['EVENT_SEARCH_EVENT_PLACEHOLDER']; ?>">
                        </li>
                        <li class="sr-cit">
                            <select id="city" name="city" class="city chosen-select">
                                <option value=""><?php echo 'All City'; ?></option>
                                <?php
                                foreach (getAllEventsCities() as $city_listrow) {

                                    if (strpos($city_listrow['city_id'], ',') !== false) {
                                        $city_id_array = array_unique(explode(',', $city_listrow['city_id']));
                                        foreach ($city_id_array as $places) {
                                            $cityrow = getCity($places);

                                            $hyphend_city_name = urlModifier($cityrow['city_name']);

                                            ?>
                                            <option <?php if ($get_city === $hyphend_city_name) {
                                                echo 'selected';
                                            } ?>
                                                    value="<?php echo $hyphend_city_name; ?>"><?php echo $cityrow['city_name']; ?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </li>
                        <li class="sr-cate">
                            <select name="cat_check" id="cat_check" class="cat_check chosen-select form-control">
                                <option value=""><?php echo 'All Category'; ?></option>
                                <?php
                                foreach (getAllEventCategories() as $categories_row) {
                                    ?>
                                    <option <?php if ($category_slug == $categories_row['category_slug']) {
                                        echo 'selected';
                                    } ?>
                                            value="<?php echo urlModifier($categories_row['category_slug']); ?>"><?php echo $categories_row['category_name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </li>
                        <li class="sr-time">
                            <?php
                            $get_sort_by = $_REQUEST['sort_by'];
                            ?>
                            <select name="sort_by" id="sort_by" class="sort_by chosen-select form-control">
                                <option <?php if ($get_sort_by == '') {
                                    echo 'selected';
                                } ?> value="">All Events
                                </option>
                                <option <?php if ($get_sort_by == 'upcoming') {
                                    echo 'selected';
                                } ?> value="upcoming">Upcoming events
                                </option>
                                <option <?php if ($get_sort_by == 'today') {
                                    echo 'selected';
                                } ?> value="today">Today events
                                </option>
                                <option <?php if ($get_sort_by == 'finished') {
                                    echo 'selected';
                                } ?> value="finished">Finished events
                                </option>
                            </select>
                        </li>
                        <li class="sr-date">
                            <div id="newdate"></div>
                        </li>
                    </ul>
                </form>
            </div>
        </br>
            <!--START-->
            <div class="filt-com lhs-ads">
                <ul>
                    <li>
                        <div class="ads-box">
                            <?php
                            $ad_position_id = 13;   //Ad position on All Events page left
                            $get_ad_row = getAds($ad_position_id);
                            $ad_enquiry_photo = $get_ad_row['ad_enquiry_photo'];
                            ?>
                            <a href="<?php echo stripslashes($get_ad_row['ad_link']); ?>">
                                <span><?php echo $BIZBOOK['AD']; ?></span>

                                <img
                                        src="<?php echo $slash; ?>images/ads/<?php if ($ad_enquiry_photo != NULL || !empty($ad_enquiry_photo)) {
                                            echo $ad_enquiry_photo;
                                        } else {
                                            echo "ads1.jpg";
                                        } ?>" alt="">
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <!--END-->
        </div>

        <div class="us-ppg-com">
            <ul id="intseres" class="events-wrapper">
                <?php
                $si = 1;

                $eventsql = "SELECT * FROM " . TBL . "events as T1 $event_end_search_query WHERE T1.event_status= 'Active' $category_search_query $events_location_search_query $event_sort_by_query $event_sort_by_search_query $event_sort_by_search_order_query";

                $eventrs = mysqli_query($conn, $eventsql);
                $total_events = mysqli_num_rows($eventrs);

                ?>
                <div class="listng-res">
                    <div class="count_no">Total of <span><?php echo AddingZero_BeforeNumber($total_events); ?></span>
                        events found.
                    </div>
                    <div class="list-res-selt">
                        <!-- //Filter Category name   -->
                        <?php
                        if (isset($_GET['category']) && !empty($_GET['category'])) { ?>
                            <span class="event-filters-span" id="<?php echo strtolower($category_search_slug); ?>"
                                  data-type="category"><?php echo $category_search_name; ?></span>
                        <?php } ?>

                        <!-- //Filter City name   -->
                        <?php
                        if (isset($_REQUEST['city']) && !empty($_REQUEST['city'])) {

                            $city1 = str_replace('-', ' ', $get_city);
                            $expert_city_row = getCityName($city1);

                            $hyphend_city_name = urlModifier($expert_city_row['city_name']);
                            ?>
                            <span class="event-filters-span" id="<?php echo $hyphend_city_name; ?>"
                                  data-type="city"><?php echo $expert_city_row['city_name']; ?></span>
                        <?php } ?>

                        <!-- //Filter Sort By   -->
                        <?php
                        //Calendar order starts
                        if (isset($_REQUEST['calendar-date']) && !empty($_REQUEST['calendar-date']) && $_REQUEST['calendar-date'] !== "[object Object]") {

                            $get_calendar_date = $_REQUEST['calendar-date'];

                            if ($get_calendar_date != '') {
                                $phpdate = strtotime($get_calendar_date);
                                $new_date = date("Y-m-d", $phpdate);
                                ?>

                                <span class="event-filters-span" id="<?php echo $get_calendar_date; ?>" data-type="calendar-date"><?php echo $new_date; ?></span>
                                <?php
                            }

                        }else {

                        if (isset($_REQUEST['sort_by']) && $_REQUEST['sort_by'] != NULL) {

                            $get_sort_by = $_REQUEST['sort_by'];

                            ?>
                            <span class="event-filters-span" id="<?php echo $get_sort_by; ?>" data-type="sort_by"><?php

                                if ($get_sort_by == "upcoming") {
                                    echo "Upcoming Events";
                                } elseif ($get_sort_by == "today") {
                                    echo "Today Events";
                                } elseif ($get_sort_by == "finished") {
                                    echo "Finished Events";
                                } ?></span>
                        <?php }
//                        else{
                            ?>
<!--                            <span class="event-filters-span" id="--><?php //echo $get_sort_by; ?><!--" data-type="sort_by">--><?php //echo "Upcoming Events"; ?><!--</span>-->
                            <?php
                        } //}?>

                        <!-- //Filter most views   -->
<!--                        <span class="event-filters-span" id="" data-type="most_views">--><?php //echo "Most Views"; ?><!--</span>-->
                    </div>
                </div>
                <?php

                if ($total_events > 0) {

                    while ($eventrow = mysqli_fetch_array($eventrs)) {

                        $user_id = $eventrow['user_id'];

                        $user_details_row = getUser($user_id);

                        ?>
                        <li class="events-item">
                            <div class="eve-box">
                                <div>
                                    <img loading="lazy" data-src="images/events/<?php echo $eventrow['event_image']; ?>"
                                         src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                         class="b-lazy"
                                         alt="">
                                    <span><?php echo dateMonthFormatconverter($eventrow['event_start_date']); ?>
                                        <b><?php echo dateDayFormatconverter($eventrow['event_start_date']); ?></b></span>
                                </div>
                                <div>
                                    <h4>
                                        <?php echo $eventrow['event_name']; ?>
                                    </h4>
                                </div>
                                <a href="<?php echo $EVENT_URL . urlModifier($eventrow['event_slug']); ?>"
                                   class="fclick"></a>
                            </div>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span style="    font-size: 21px;
    color: #bfbfbf;
    letter-spacing: 1px;
    /* background: #525252; */
    text-shadow: 0px 0px 2px #fff;
    text-transform: uppercase;
    margin-top: 5%;"><?php echo $BIZBOOK['EVENTS_NO_EVENTS_MESSAGE']; ?></span>
                    <?php
                }
                ?>
            </ul>
        </div>

    </div>
</section>
<!--END-->

<section>
    <div class="pop-ups pop-quo">
        <!-- The Modal -->
        <div class="modal fade" id="quote">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="quote-pop">
                        <h4><?php echo $BIZBOOK['LEAD-GET-QUOTE']; ?></h4>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['LEAD-NAME-PLACEHOLDER']; ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['ENTER_EMAIL_STAR']; ?>"
                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                       title="<?php echo $BIZBOOK['LEAD-INVALID-EMAIL-TITLE']; ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['LEAD-MOBILE-PLACEHOLDER']; ?>"
                                       pattern="[7-9]{1}[0-9]{9}"
                                       title="<?php echo $BIZBOOK['LEAD-INVALID-MOBILE-TITLE']; ?>" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3"
                                          placeholder="<?php echo $BIZBOOK['LEAD-MESSAGE-PLACEHOLDER']; ?>"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT']; ?></button>
                        </form>
                    </div>
                    <div class="log-bor">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="event-pagination-container"></div>
<?php
include "footer.php";
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/select-opt.js"></script>
<script type="text/javascript">var webpage_full_link = '<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url = '<?php echo $LOGIN_URL;?>';</script>
<script src="js/slick.js"></script>
<script src="<?php echo $slash; ?>js/blazy.min.js"></script>
<script src="js/custom.js"></script>
<script src="<?php echo $slash; ?>js/event_filter.js"></script>
<!--<script src="js/jquery.simplePagination.min.js"></script>-->
<script>
    $(document).ready(function () {
        var bLazy = new Blazy({});
    });
    /*var items = $(".events-wrapper .events-item");
     var numItems = items.length;
     var perPage = 9;

     items.slice(perPage).hide();

     $('#event-pagination-container').pagination({
     items: numItems,
     itemsOnPage: perPage,
     prevText: "&laquo;",
     nextText: "&raquo;",
     onPageClick: function (pageNumber) {
     var showFrom = perPage * (pageNumber - 1);
     var showTo = showFrom + perPage;
     items.hide().slice(showFrom, showTo).show();
     $("html, body").animate({ scrollTop: 0 }, "fast");
     return false;
     }
     });*/
    $('.multiple-items1').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }]

    });
</script>
<?php
//if (isset($_REQUEST['calendar-date']) && !empty($_REQUEST['calendar-date'])) {?>
    <script>
    $("#newdate").datepicker(
        "setDate", "<?php echo date('2023-05-05'); ?>"
    );
    <?php
//} ?>
</body>
</html>