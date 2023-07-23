<?php
include "header.php";
?>
<style>
.ind10-home{}
.hom-head:after{display:none;}
.hom-head{background-image: url(images/88129ex2.jpg);    padding: 0px 0px 90px 0px;margin-bottom:30px}
.job-list{padding:0;}
.ind10-home {
    background: #fff6dd;
    background: -webkit-linear-gradient(to bottom, #fff6dd, #ffffff);
    background: linear-gradient(to bottom, #fff6dd, #ffffff);
}
.ban-short-links ul li div{    border: 1px solid #c9c9c9;    background: #fff;}
.ban-tit h1, .ban-tit h1 b, .ban-short-links ul li div h4 {
    color: #000;}
    .ban-search.ban-sear-all{    background: #000000b8;    box-shadow: 0 0px 0px 10px #0000001f;}
</style>



<!--START-->
<section>
        <div class="plac-hom-bd">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2><h2><span><?php echo $BIZBOOK['HOM-POP-TIT']; ?></span> <?php echo $BIZBOOK['HOM-POP-TIT1']; ?></h2></h2>
                    </div>
                    <div class="plac-hom-all-pla">
                        <ul class="travel-sliser">
                        <?php
                        foreach (getAllCategories() as $category_sql_row) {
                            ?>
                            <li>
                                <div class="plac-hom-box">
                                    <div class="plac-hom-box-im">
                                    <img src="images/services/<?php echo $category_sql_row['category_image']; ?>" alt="">
                                    <h4><?php echo $category_sql_row['category_name']; ?></h4>
                                    </div>
                                    <div class="plac-hom-box-txt">
                                        <span>Listing: <?php echo AddingZero_BeforeNumber(getCountCategoryListing($category_sql_row['category_id'])); ?></span>
                                        <span>More details</span>
                                    </div>
                                        <a href="all-listing?category=<?php echo preg_replace('/\s+/', '-', strtolower($category_sql_row['category_name'])); ?>" class="fclick"></a>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                         </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->
<!--START-->
<section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2><span><?php echo $BIZBOOK['HOM-BAN-TIT-CAT']; ?></span></h2>
                    </div>
                    <div class="plac-hom-all-pla">
                    <ul class="travel-sliser">
                    <?php
                        foreach (getAllActiveExpertCategoriesPos() as $expert_categories_row) {

                            $category_name = $expert_categories_row['category_name'];

                            $category_id = $expert_categories_row['category_id'];

                            $total_experts_category = getCountCategoryExperts($category_id);
                            ?>
                            <li>
                                <div class="plac-hom-box">
                                    <div class="plac-hom-box-im">
                                    <img src="<?php echo $slash; ?>service-experts/images/services/<?php echo $expert_categories_row['category_image']; ?>"
                                            alt="">
                                    <h4><?php echo $category_name; ?></h4>
                                    </div>
                                    <div class="plac-hom-box-txt">
                                        <span><?php echo $BIZBOOK['SERVICE-EXPERTS-EXPERTS']; ?> <?php echo $total_experts_category; ?></span>
                                        <span>More details</span>
                                    </div>
                                        <a href="<?php echo $ALL_EXPERTS_URL . urlModifier($expert_categories_row['category_slug']); ?>" class="fclick"></a>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                         </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->


<!--START-->
<section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com" id="near">
            <div class="container">
                <div class="row">
                    <div class="plac-hom-tit plac-hom-tit-ic-ser">
                    <h2><span><?php echo $BIZBOOK['HOM-BEST-TIT']; ?></span> <?php echo $BIZBOOK['HOM-BEST-TIT1']; ?>
                    </h2>
                    <p><?php echo $BIZBOOK['HOM-BEST-SUB-TIT']; ?></p>
                    </div>
                    <div class="plac-hom-all-pla">
                    <ul class="travel-sliser">
                    <?php
                            $pop_bus = 1;
                            foreach (getAllFeaturedListing() as $row) {

                                $listing_id = $row['listing_id'];

                                $listing_sql_row = getIdListing($listing_id);
                                $featured_category_id = $listing_sql_row['category_id'];

                                $popular_business_category_sql_row = getCategory($featured_category_id);

                                // List Rating. for Rating of Star
                                foreach (getListingReview($listing_id) as $star_rating_row) {
                                    if ($star_rating_row["rate_cnt"] > 0) {
                                        $star_rate_times = $star_rating_row["rate_cnt"];
                                        $star_sum_rates = $star_rating_row["total_rate"];
                                        $star_rate_one = $star_sum_rates / $star_rate_times;
                                        //$star_rate_one = (($Star_rate_value)/5)*100;
                                        $star_rate_two = number_format($star_rate_one, 1);
                                        $star_rate = $star_rate_two;

                                    } else {
                                        $rate_times = 0;
                                        $rate_value = 0;
                                        $star_rate = 0;
                                    }
                                }

                                ?>
                        <li>
                            <div class="plac-hom-box">
                                <div class="plac-hom-box-im">
                                <img src="<?php if ($listing_sql_row['profile_image'] != NULL || !empty($listing_sql_row['profile_image'])) { echo "images/listings/" . $listing_sql_row['profile_image'];
                                            } else {
                                                echo "images/listings/hot4.jpg";
                                            } ?>" alt="">
                                    <h4><?php echo $listing_sql_row['listing_name']; ?></h4>
                                    <span class="plac-det-cate"><?php echo $popular_business_category_sql_row['category_name']; ?></span>
                                </div>
                                <div class="plac-hom-box-txt">
                                    <div class="revi-box-1">
                                        <b>5.0</b>
                                        <?php if ($star_rate != 0) { ?>
                                                <label class="rat">
                                                    <?php
                                                    for ($i = 1; $i <= ceil($star_rate_two); $i++) {
                                                        ?>
                                                        <i class="material-icons">star</i>
                                                        <?php
                                                    }
                                                    $bal_star_rate = abs(ceil($star_rate_two) - 5);

                                                    for ($i = 1; $i <= $bal_star_rate; $i++) {
                                                        ?>
                                                        <i class="material-icons">star_border</i>
                                                        <?php
                                                    }
                                                    ?>
                                                </label>
                                            <?php } ?>
                                        <span class="re-cnt">Reviews</span>
                                    </div>
                                    <span>More details</span>
                                </div>
                                    <a href="<?php echo $LISTING_URL . urlModifier($listing_sql_row['listing_slug']); ?>"
                                           class="fclick"></a>
                            </div>
                        </li>
                        <?php
                                $pop_bus++;
                            }
                            ?>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->

    

    <!--START-->
<section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
            <div class="container">
                <div class="row">
                    <div class="plac-hom-tit plac-hom-tit-ic-eve">
                    <h2><span><?php echo $BIZBOOK['HOM-EVE-TIT']; ?></span> <?php echo $BIZBOOK['HOM-EVE-TIT1']; ?></h2>
        <p><?php echo $BIZBOOK['HOM-EVE-SUB-TIT']; ?></p>
                    </div>
                    <div class="plac-hom-all-pla plac-det-eve">
                    <ul class="travel-sliser">
                    <?php

                foreach (getAllTopEvents() as $topeventrow_1) { //To Fetch Top Events First Two Rows using position Id

                    $event_name = $topeventrow_1['event_name'];

                    $event_sql_row = getEvent($event_name);

                    $user_id = $event_sql_row['user_id'];

                    $user_details_row = getUser($user_id);

                    ?>
                        <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                        <img src="images/events/<?php echo $event_sql_row['event_image']; ?>" alt="">
                                            <h4><?php echo $event_sql_row['event_name']; ?></h4>
                                            <span class="plac-det-cate"><?php echo dateMonthFormatconverter($event_sql_row['event_start_date']); ?> <?php echo dateDayFormatconverter($event_sql_row['event_start_date']); ?></span>
                                        </div>
                                        <a href="<?php echo $EVENT_URL . urlModifier($event_sql_row['event_slug']); ?>" class="fclick"></a>
                                    </div>
                                </li>
                                <?php
                }
                ?>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->


    <!--START-->
<section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
            <div class="container">
                <div class="row">
                <div class="plac-hom-tit plac-hom-tit-ic-nws">
                    <h2><?php echo $BIZBOOK['NEWS-HOMEPAGE-BANNER-H1-TEXT-2']; ?> <b><?php echo $place_row['place_name']; ?></b></h2>
                    <p><?php echo $BIZBOOK['NEWS-HOMEPAGE-BANNER-P-TEXT']; ?> <b><?php echo $BIZBOOK['PLACE-NEWS-B']; ?></b></p>
                </div>
                    <div class="plac-hom-all-pla plac-det-eve">
                    <ul class="travel-sliser">
                    <?php
            foreach (getAllNewsSlider() as $home_page_slider_row) {

                $home_page_slider_news_id = $home_page_slider_row['news_id'];

                $home_page_slider_news_slider_id = $home_page_slider_row['news_slider_id'];

                $home_page_slider_news_sql_row = getIdNews($home_page_slider_news_id);

                $home_page_slider_category_id = $home_page_slider_news_sql_row['category_id'];

                $home_page_slider_category_row = getNewsCategory($home_page_slider_category_id);

                $home_page_slider_category_name = $home_page_slider_category_row['category_name'];

                ?>
                        <li>
                            <div class="plac-hom-box">
                                <div class="plac-hom-box-im">
                                <img src="<?php echo $slash; ?>news/images/news/<?php echo $home_page_slider_news_sql_row['news_image']; ?>"
                                alt="">

                                    <h4><?php echo stripslashes($home_page_slider_news_sql_row['news_title']); ?></h4>
                                    <span class="plac-det-cate"><?php echo $home_page_slider_category_name; ?></span>
                                </div>
                                <a href="<?php echo $NEWS_DETAIL_URL . urlModifier($home_page_slider_news_sql_row['news_slug']); ?>"
                           class="fclick"></a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->

<!-- START -->
<section>
    <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
        <div class="container">
            <div class="row">
            <div class="plac-hom-tit plac-hom-tit-ic-jbs">
                    <h2><?php echo $BIZBOOK['JOB-HEADER-H4']; ?> <b><?php echo $place_row['place_name']; ?></b></h2>
                    <p><?php echo $BIZBOOK['HOM-BEST-SUB-TIT']; ?> <b><?php echo $BIZBOOK['PLACE-NEWS-B']; ?></b></p>
                </div>
                <div class="plac-hom-all-pla job-list">
                    <ul class="travel-sliser">
                        <?php
                        $si = 1;

                        foreach (getAllJobPopular() as $row) {

                            $job_name = $row['job_name'];

                            $job_popular_id = $row['job_popular_id'];

                            $job_sql_row = getIdJob($job_name);
                            $job_id = $job_sql_row['job_id'];
                            $total_count_jobs_applied = getCountJobAppliedJob($job_id);

                            ?>
                            <li>
                                <div class="job-box">
                                    <div class="job-box-img">
                                        <img src="<?php echo $slash; ?>jobs/images/jobs/<?php echo $job_sql_row['company_logo']; ?>" alt="">
                                    </div>
                                    <div class="job-days">
                                        <span class="day"><?php echo time_elapsed_string($job_sql_row['job_cdt']); ?></span>
                                        <span class="apl"><?php echo $total_count_jobs_applied; ?> <?php echo $BIZBOOK['APPLICANTS']; ?></span>
                                    </div>
                                    <div class="job-box-con">
                                        <h4><?php echo $job_sql_row['job_title']; ?></h4>
                                        <span><?php
                                            $job_type = $job_sql_row['job_type'];
                                            if ($job_type == 1) {
                                                echo $BIZBOOK['JOB-PERMANENT'];
                                            } elseif ($job_type == 2) {
                                                echo $BIZBOOK['JOB-CONTRACT'];
                                            } elseif ($job_type == 3) {
                                                echo $BIZBOOK['JOB-PART-TIME'];
                                            } elseif ($job_type == 4) {
                                                echo $BIZBOOK['JOB-FREELANCE'];
                                            }
                                            ?></span>
                                        <span><?php echo $job_sql_row['job_role']; ?></span>
                                        <span><?php echo AddingZero_BeforeNumber($job_sql_row['no_of_openings']); ?> <?php echo $BIZBOOK['JOB_OPENINGS']; ?></span>
                                    </div>
                                    <div class="job-box-apl">
                                        <span class="job-box-cta"><?php echo $BIZBOOK['JOB_APPLY_NOW']; ?></span>
                                    </div>
                                    <a href="<?php echo $JOB_URL . urlModifier($job_sql_row['job_slug']); ?>" class="job-full-cta"></a>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->    




<!-- START -->
<section>
    <div class="str count">
        <div class="container">
            <div class="row">
                
                <div class="how-wrks">
                    <div class="home-tit">
                        <h2><span><?php echo $BIZBOOK['HOM-HOW-TIT']; ?></span></h2>
                        <p><?php echo $BIZBOOK['HOM-HOW-SUB-TIT']; ?></p>
                    </div>
                    <div class="how-wrks-inn">
                        <ul>
                            <li>
                                <div>
                                    <span>1</span>
                                    <img src="images/icon/how1.png" alt="">
                                    <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-1']; ?></h4>
                                    <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-1']; ?></p>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <span>2</span>
                                    <img src="images/icon/how2.png" alt="">
                                    <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-2']; ?></h4>
                                    <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-2']; ?></p>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <span>3</span>
                                    <img src="images/icon/how3.png" alt="">
                                    <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-3']; ?></h4>
                                    <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-3']; ?></p>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <span>4</span>
                                    <img src="images/icon/how4.png" alt="">
                                    <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-4']; ?></h4>
                                    <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-4']; ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->


<!-- START -->
<section>
    <div class="hom-ads">
        <div class="container">
            <div class="row">
                <div class="filt-com lhs-ads">
                    <div class="ads-box">
                        <?php
                        $ad_position_id = 1;   //Ad position on home page bottom
                        $get_ad_row = getAds($ad_position_id);
                        $ad_enquiry_photo = $get_ad_row['ad_enquiry_photo'];
                        ?>
                        <a href="<?php echo stripslashes($get_ad_row['ad_link']); ?>">
                            <span>Ad</span>

                            <img src="images/ads/<?php if ($ad_enquiry_photo != NULL || !empty($ad_enquiry_photo)) {
                                echo $ad_enquiry_photo;
                            } else {
                                echo "ads2.jpg";
                            } ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- START -->
<div class="ani-quo">
    <div class="ani-q1">
        <h4><?php echo $BIZBOOK['HOM-WHAT-LOOK-TIT']; ?></h4>
        <p><?php echo $BIZBOOK['HOM-WHAT-LOOK-SUB']; ?></p>
        <span><?php echo $BIZBOOK['HOM-WHAT-LOOK-CTA']; ?></span>
    </div>
    <div class="ani-q2">
        <img src="images/quote.png" alt="">
    </div>
</div>
<!-- END -->

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
<script src="js/custom.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>
<script src="js/slick.js"></script>
<script>
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 250) {
            $(".hom-top").addClass("dmact");
        }
        else {
            $(".hom-top").removeClass("dmact");
        }
    });

$('.travel-sliser').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
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
</body>

</html>