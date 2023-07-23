<?php
include "header.php";

if ($footer_row['admin_blog_show'] != 1) {
    header("Location: " . $webpage_full_link . "dashboard");
}

?>

<?php
if (isset($_REQUEST['category']) && !empty($_GET['category'])) {


    $category_search_slug = trim(str_replace('-', ' ', $_GET['category']));

    $cat_search_row = getSlugBlogCategory($category_search_slug);  //Fetch Category Id using category name

    $category_id = $cat_search_row['category_id'];

    $category_slug = $cat_search_row['category_slug'];

    $category_search_name = $cat_search_row['category_name'];

    $category_search_query = "AND FIND_IN_SET($category_id, T1.category_id)";

}

//Service Ratings Order By Check starts
if (isset($_REQUEST['sort_by']) && !empty($_REQUEST['sort_by'])) {

    $get_rating_order = $_REQUEST['sort_by'];

    if ($get_rating_order == 'most-views') {

        $blog_sort_by_search_query = 'GROUP BY T2.blog_id';
        $blog_start_search_query = ', T2.blog_id, COUNT(T2.blog_id) as top';
        $blog_end_search_query = "INNER JOIN " . TBL . "page_views AS T2 ON T1.blog_id = T2.blog_id";

        $blog_sort_by_search_order_query = 'ORDER BY top DESC';
    } else {
        $blog_sort_by_search_order_query = 'ORDER BY T1.blog_id DESC';
    }

} else {
    $blog_sort_by_search_order_query = 'ORDER BY T1.blog_id DESC';
}

?>

<!-- START -->
<section class="<?php if ($footer_row['admin_language'] == 2) {
    echo "lg-arb";
} ?> blog-body">
    <div class="container">
        <?php //if (!isset($_GET['category']) ) { ?>
        <div class="blog-sli">
            <ul class="multiple-items1">
                <?php
                $si = 1;
                foreach (getAllTopViewsPremiumActiveBlogs() as $top_blog_row) {

                    $top_user_id = $top_blog_row['user_id'];

                    $top_user_details_row = getUser($top_user_id);

                    ?>
                    <li>
                        <div class="blog-sli-box">
                            <div class="lhs">
                                <img loading="lazy" src="images/blogs/<?php echo $top_blog_row['blog_image']; ?>" alt="">
                            </div>

                            <div class="rhs">
                                <span class="hig"><?php echo $BIZBOOK['BLOG_TOP_POSTS']; ?></span>
                                <h4><?php echo $top_blog_row['blog_name']; ?></h4>
                                <div class="auth">
                                    <img loading="lazy"
                                         src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                         data-src="<?php echo $slash; ?>images/user/<?php if (($top_user_details_row['profile_image'] == NULL) || empty($top_user_details_row['profile_image'])) {
                                             echo $footer_row['user_default_image'];
                                         } else {
                                             echo $top_user_details_row['profile_image'];
                                         } ?>" alt="" class="b-lazy">
                                    <b><?php echo $BIZBOOK['HOM3-OW-POSTED-BY']; ?></b><br>
                                    <h6><?php echo $top_blog_row['first_name']; ?></h6>
                                </div>
                            </div>
                            <a href="<?php echo $BLOG_URL . urlModifier($top_blog_row['blog_slug']); ?>"
                               class="fclick"></a>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php //} ?>

        <div class="blog-head-inn">
            <h1><?php echo $BIZBOOK['BLOG_POSTS']; ?></h1>
            <p><?php echo $BIZBOOK['BLOG-POST-HEAD']; ?></p>
            <div class="ban-search">
                <form>
                    <ul>
                        <li class="sr-sea">
                            <input type="text" id="blog-search" class="autocomplete"
                                   placeholder="<?php echo $BIZBOOK['BLOG-POST-SEARCH-LABEL']; ?>">
                        </li>
                        <li class="sr-cate">
                            <select name="cat_check" id="cat_check" class="cat_check chosen-select form-control">
                                <option value=""><?php echo $BIZBOOK['SELECT_CATEGORY']; ?></option>
                                <?php
                                foreach (getAllBlogCategories() as $categories_row) {
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
                            <select name="sort_by" id="sort_by" class="sort_by chosen-select form-control">
                                <option <?php if ($get_rating_order == "recent-posts") {
                                    echo 'selected';
                                } ?> value="recent-posts">Recent posts
                                </option>
                                <option <?php if ($get_rating_order == "most-views") {
                                    echo 'selected';
                                } ?> value="most-views">Most views
                                </option>
                            </select>
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
                            $ad_position_id = 14;   //Ad position on All Blogs page left
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

        <div class="us-ppg-com us-ppg-blog">
            <ul id="intseres" class="blog-wrapper">
                <?php
                $si = 1;

                $blogsql = "SELECT  T1.* $blog_start_search_query FROM " . TBL . "blogs AS T1 $blog_end_search_query WHERE T1.blog_status = 'Active' $category_search_query $blog_sort_by_search_query $blog_sort_by_search_order_query";

                $blogrs = mysqli_query($conn, $blogsql);
                $total_blogs = mysqli_num_rows($blogrs);
                ?>

                <div class="listng-res">
                    <div class="count_no">Total of <span><?php echo AddingZero_BeforeNumber($total_blogs); ?></span>
                        blogs found.
                    </div>
                    <div class="list-res-selt">
                        <!-- //Filter Category name   -->
                        <?php
                        if (isset($_GET['category']) && !empty($_GET['category'])) { ?>
                            <span class="blog-filters-span" id="<?php echo strtolower($category_search_slug); ?>"
                                  data-type="category"><?php echo $category_search_name; ?></span>
                        <?php } ?>

                        <!-- //Filter Sort By   -->
                        <?php
                        if (isset($_REQUEST['sort_by']) && $_REQUEST['sort_by'] != NULL) {
                            ?>
                            <span class="blog-filters-span" id="<?php echo $get_availability; ?>" data-type="sort_by"><?php

                                if ($get_rating_order == "recent-posts") {
                                    echo "Recent posts";
                                } elseif ($get_rating_order == "most-views") {
                                    echo "Most views";
                                } ?></span>
                        <?php } ?>
                    </div>
                </div>

                <?php

                if ($total_blogs > 0) {

                    while ($blogrow = mysqli_fetch_array($blogrs)) {

                        $user_id = $blogrow['user_id'];

                        $user_details_row = getUser($user_id);

                        ?>
                        <li class="blog-item">
                            <div class="pro-eve-box">
                                <div>
                                    <img loading="lazy" data-src="images/blogs/<?php echo $blogrow['blog_image']; ?>"
                                         src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                         class="b-lazy" alt="">
                                </div>
                                <div>
                                    <h2><?php echo $blogrow['blog_name']; ?></h2>
                                    <span class="ic-time"><?php echo dateFormatconverter($blogrow['blog_cdt']); ?></span>
                                    <span class="ic-view"><?php echo blog_pageview_count($blogrow['blog_id']); ?></span>
                                </div>
                                <a href="<?php echo $BLOG_URL . urlModifier($blogrow['blog_slug']); ?>" class="fclick">
                                    &nbsp;</a>
                            </div>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <span style="font-size: 21px;
    color: #bfbfbf;
    letter-spacing: 1px;
    /* background: #525252; */
    text-shadow: 0px 0px 2px #fff;
    text-transform: uppercase;
    margin-top: 5%;"><?php echo $BIZBOOK['BLOGS_NO_BLOGS_MESSAGE']; ?></span>
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
<div id="blog-pagination-container"></div>
<?php
include "footer.php";
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="<?php echo $slash; ?>js/select-opt.js"></script>
<script src="<?php echo $slash; ?>js/blazy.min.js"></script>
<script type="text/javascript">var webpage_full_link = '<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url = '<?php echo $LOGIN_URL;?>';</script>
<script src="js/slick.js"></script>
<script src="js/custom.js"></script>
<script src="<?php echo $slash; ?>js/blog_filter.js"></script>
<script src="<?php echo $slash; ?>js/blazy.min.js"></script>
<script>
    $(document).ready(function () {
        var bLazy = new Blazy({});
    });
    $('.multiple-items1').slick({
        infinite: true,
        slidesToShow: 1,
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
</body>

</html>