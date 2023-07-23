<?php
include "header.php";

if($footer_row['admin_product_show'] != 1) {
    header("Location: ".$webpage_full_link."dashboard");
}

if (isset($_SESSION['user_id'])) {
    $session_user_id = $_SESSION['user_id'];
}
$user_details_row = getUser($session_user_id);

$redirect_url = $webpage_full_link.'dashboard';  //Redirect Url

if ($_GET['code'] == NULL && empty($_GET['code'])) {

    header("Location: $redirect_url");
}
 
$product_codea1 = str_replace('-', ' ', $_GET['code']);
$product_codea = str_replace('.php', '', $product_codea1);

$productrow = getSlugProduct($product_codea); //To Fetch the product

$product_id = $productrow['product_id'];
$product_user_id = $productrow['user_id'];

$product_category_id = $productrow['category_id'];

$product_category_row = getProductCategory($product_category_id); //Product Category Database Fetch

$product_category_slug = $product_category_row['category_slug'];

if ($product_id == NULL && empty($product_id)) {

    header("Location: $redirect_url");  //Redirect When No product Found in Table
}

productpageview($product_id); //Function To Find Page View

$usersqlrow = getUser($product_user_id); // To Fetch particular User Data

$user_plan = $usersqlrow['user_plan'];


$plan_type_row = getPlanType($user_plan); //User Plan Type Database Fetch

?>
<div class="all-list-bre all-pro-bre">
    <div class="container sec-all-list-bre">
        <div class="row">
            <h2><?php echo $product_category_row['category_name']; ?></h2>
            <ul>
                <li><a href="<?php echo $slash; ?>index"><?php echo $BIZBOOK['HOME']; ?></a></li>
                <li><a href="<?php echo $slash; ?>all-products"><?php echo $BIZBOOK['ALL_CATEGORY']; ?></a></li>
                <li><a href="<?php echo $ALL_PRODUCTS_URL . urlModifier($product_category_slug); ?>"><?php echo $product_category_row['category_name']; ?></a></li>
                <li><a href="#!"><?php echo $productrow['product_name']; ?></a></li>
            </ul>
        </div>
    </div>
</div>


<!-- START -->
<section class="biz-pro">
    <div class="container">
        <div class="row">
            <div class="col-md-5 lhs">
                <div class="bpro-sli">
                    <div id="demo" class="carousel slide" data-ride="carousel">
                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            <?php
                            $gallery_image_array = $productrow['gallery_image'];
                            $gallery_image = explode(',', $gallery_image_array);
                            ?>
                            <?php

                            $p = 1;
                            foreach ($gallery_image as $item) {

                                ?>
                                <div class="carousel-item <?php if ($p == 1) {
                                    echo "active";
                                } ?>">
                                    <img loading="lazy" src="<?php echo $slash; ?>images/products/<?php echo $item; ?>"
                                         alt="<?php echo $item; ?>">
                                </div>
                                <?php
                                $p++;
                            }
                            ?>
                        </div>
                        <?php
                        if (count($gallery_image) > 1) {
                            ?>
                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="biz-pro-btn">
                <a data-toggle="modal" data-target="#quote" class="btn btn1"><?php echo $BIZBOOK['LEAD-GET-QUOTE']; ?></a>
                    <!--<span class="btn btn1 cta-add-cart">Add to cart</span>
                    <a href="cart" class="btn btn2">Buy now</a>-->
                    <a <?php if($productrow['product_payment_link'] != NULL ){ ?> target="_blank" href="<?php echo $productrow['product_payment_link']; } else{ echo "#!";} ?>" class="btn btn2" rel="nofollow"><?php echo $BIZBOOK['BUY_NOW']; ?></a>
                </div>
            </div>
            <div class="col-md-7 rhs">
                <div class="pro-pri-box">
                    <div class="pro-pbox-2">
                        <?php
                        if ($plan_type_row['plan_type_verified'] == '1') {
                            ?>
                            <span class="veri"><?php echo $BIZBOOK['VERIFIED']; ?></span>
                            <?php
                        }
                        ?>
                        <h1><?php echo $productrow['product_name']; ?></h1>
                        <span class="rat">4.0</span>
                        <span
                            class="pro-cost"><?php if($footer_row['currency_symbol_pos']== 1){ echo $footer_row['currency_symbol']; }  echo $productrow['product_price'];  if($footer_row['currency_symbol_pos']== 2){ echo $footer_row['currency_symbol']; } ?> <?php if ($productrow['product_price_offer'] != NULL) { ?>
                                <b class="pro-off"><?php echo $productrow['product_price_offer']; ?>% off</b><?php } ?></span>
                    </div>
                    <?php if ($productrow['product_highlights'] != NULL) { ?>
                        <div class="pro-pbox-3 pro-pbox-com">
                            <h4><?php echo $BIZBOOK['HIGHLIGHTS']; ?></h4>
                            <ul>
                                <?php
                                $products_a_row_product_highlights_Array = explode('|', $productrow['product_highlights']);

                                foreach ($products_a_row_product_highlights_Array as $tuple) {
                                    if ($tuple != NULL) {
                                        ?>
                                        <li><?php echo $tuple; ?></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="pro-pbox-4 pro-pbox-com">
                        <h4><?php echo $BIZBOOK['DESCRIPTIONS']; ?></h4>
                        <p><?php echo $productrow['product_description']; ?></p>
                    </div>

                    <?php if ($productrow['product_info_question'] != NULL) { ?>
                        <div class="pro-pbox-5 pro-pbox-com">
                            <h4><?php echo $BIZBOOK['SPECIFICATIONS'];?></h4>
                            <ul>
                                <?php
                                $products_a_row_product_info_question_Array = explode(',', $productrow['product_info_question']);
                                $products_a_row_product_info_answer_Array = explode(',', $productrow['product_info_answer']);

                                $zipped = array_map(null, $products_a_row_product_info_question_Array, $products_a_row_product_info_answer_Array);

                                foreach ($zipped as $tuple) {
                                    $tuple[0]; // Info question
                                    $tuple[1]; // Info Answer
                                    if ($tuple[0] != NULL) {
                                        ?>
                                        <li>
                                            <span class="pro-spe-li"><?php echo $tuple[0]; ?></span>:
                                            <span class="pro-spe-po">&nbsp;&nbsp;<?php echo $tuple[1]; ?></span>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="pro-pbox-7 pro-pbox-com">
                        <h4><?php echo $BIZBOOK['TAGS']; ?></h4>
                        <?php
                        $products_a_row_product_tags_Array = explode(',', $productrow['product_tags']);

                        foreach ($products_a_row_product_tags_Array as $tuple) {
                            if ($tuple != NULL) {
                                ?>
                                <a href="<?php echo $slash; ?>search-results?q=<?php echo $tuple; ?>"><?php echo $tuple; ?></a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="pro-pbox-6 pro-pbox-com">
                        <h4><?php echo $BIZBOOK['CREATED_BY']; ?></h4>
                        <div class="pro-bad-sml">
                            <img loading="lazy" src="<?php echo $slash; ?>images/user/<?php if (($usersqlrow['profile_image'] == NULL) || empty($usersqlrow['profile_image'])) {
                                echo $footer_row['user_default_image'];
                            } else {
                                echo $usersqlrow['profile_image'];
                            } ?>" alt="">
                            <h4><?php echo $usersqlrow['first_name']; ?></h4>
                            <b><?php echo $BIZBOOK['JOIN_ON']; ?> <?php $user_date = $usersqlrow['user_cdt'];
                                $user_date1 = strtotime($user_date);
                                echo date("M Y", $user_date1); ?></b>
                            <a href="<?php echo $PROFILE_URL.urlModifier($usersqlrow['user_slug']); ?>" target="_blank" class="fclick">&nbsp;</a>
                        </div>
                    </div>
                    <div class="list-sh">
                        <span class="share-new" data-toggle="modal" data-target="#sharepop"><i class="material-icons">share</i> Share now</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END-->

<!-- START -->
<section class="eve-deta-body blog-deta-body">
    <div class="container">
        <div class="list-det-rel-pre pro-rel-pros">
            <h2><?php echo $BIZBOOK['BLOG-DETAILS-RELATED-POST']; ?></h2>
                <ul class="multiple-items1">
                    <?php
                    $si = 1;
                    foreach (getExceptProduct($product_id) as $productErow) {

                        ?>
                        <li>
                            <div class="plac-hom-box">
                                <div class="plac-hom-box-im">
                                <img loading="lazy" src="<?php echo $slash; ?>images/products/<?php echo array_shift(explode(',', $productErow['gallery_image'])); ?>" alt="">
                                <h4><?php echo $productErow['product_name']; ?></h4>
                                </div>
                                <div class="plac-hom-box-txt">
                                    <span><?php if($footer_row['currency_symbol_pos']== 1){ echo $footer_row['currency_symbol']; } ?><?php echo $productErow['product_price']; ?><?php if($footer_row['currency_symbol_pos']== 2){ echo $footer_row['currency_symbol']; } ?></span>
                                    <span><?php echo $BIZBOOK['PLACE-MORE-DETAILS']; ?></span>
                                </div>
                                <a href="<?php echo $PRODUCT_URL.urlModifier($productErow['product_slug']); ?>"
                                    class="fclick"></a>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
        </div>
    </div>
</section>
<!--END-->

<?php
include "footer.php";
?>

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
                        <div id="product_detail_enq_success" class="log" style="display: none;"><p><?php echo $BIZBOOK['ENQUIRY_SUCCESSFUL_MESSAGE']; ?></p>
                        </div>
                        <div id="product_detail_enq_same" class="log" style="display: none;"><p><?php echo $BIZBOOK['ENQUIRY_OWN_PRODUCT_MESSAGE']; ?></p>
                        </div>
                        <div id="product_detail_enq_fail" class="log" style="display: none;"><p><?php echo $BIZBOOK['OOPS_SOMETHING_WENT_WRONG']; ?></p>
                        </div>
                        <form method="post" name="product_detail_enquiry_form" id="product_detail_enquiry_form">
                            <input type="hidden" class="form-control" name="product_id"
                                   value="<?php echo $product_id; ?>"
                                   placeholder=""
                                   required>
                            <input type="hidden" class="form-control"
                                   name="listing_user_id"
                                   value="<?php echo $product_user_id; ?>" placeholder=""
                                   required>
                            <input type="hidden" class="form-control"
                                   name="enquiry_sender_id"
                                   value="<?php echo $session_user_id; ?>"
                                   placeholder=""
                                   required>
                            <input type="hidden" class="form-control"
                                   name="enquiry_source"
                                   value="<?php if (isset($_GET["src"])) {
                                       echo $_GET["src"];
                                   } else {
                                       echo "Website";
                                   }; ?>"
                                   placeholder=""
                                   required>
                            <div class="form-group">
                                <input type="text" name="enquiry_name"
                                       value="<?php echo $user_details_row['first_name'] ?>"
                                       required="required" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['LEAD-NAME-PLACEHOLDER']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['ENTER_EMAIL_STAR']; ?>" required="required"
                                       value="<?php echo $user_details_row['email_id'] ?>"
                                       name="enquiry_email"
                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                       title="<?php echo $BIZBOOK['LEAD-INVALID-EMAIL-TITLE']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control"
                                       value="<?php echo $user_details_row['mobile_number'] ?>"
                                       name="enquiry_mobile"
                                       placeholder="<?php echo $BIZBOOK['LEAD-MOBILE-PLACEHOLDER']; ?>"
                                       pattern="[7-9]{1}[0-9]{9}"
                                       title="<?php echo $BIZBOOK['LEAD-INVALID-MOBILE-TITLE']; ?>"
                                       required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="enquiry_message"
                                          placeholder="<?php echo $BIZBOOK['LEAD-MESSAGE-PLACEHOLDER']; ?>"></textarea>
                            </div>
                            <input type="hidden" id="source">
                            <button  <?php if ($session_user_id == NULL || empty($session_user_id)) {
                                ?> disabled="disabled" <?php } ?> type="submit" id="product_detail_enquiry_submit" name="enquiry_submit"
                                                                  class="btn btn-primary"><?php if ($session_user_id == NULL || empty($session_user_id)) {
                                    ?> <?php echo $BIZBOOK['LOG_IN_TO_SUBMIT'];?> <?php }else{ ?><?php echo $BIZBOOK['SUBMIT']; ?> <?php }?>
                            </button>
                        </form>
                    </div>
                    <div class="log-bor">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SHARE POPUP -->
<div class="modal fade sharepop" id="sharepop">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Share now</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <input type="text" value="" id="shareurl">
                <div class="shareurltip">
                    <button onclick="shareurl()" onmouseout="shareurlout()">
                        <span class="shareurltxt" id="myTooltip">Copy to clipboard</span>
                        Copy text </button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="cart-box">
    <div class="cart-head">
        Items list
    </div>
    <div class="cart-list">
        <ul>
            <li>Cotton and Accessories <span>&99</span></li>
            <li>Cotton and Accessories <span>&99</span></li>
        </ul>
    </div>
    <div class="cart-process">
        <a href="cart" class="cta-caps btn-cart-plac">Place orer</a>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $slash; ?>js/jquery.min.js"></script>
<script src="<?php echo $slash; ?>js/popper.min.js"></script>
<script src="<?php echo $slash; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash; ?>js/jquery-ui.js"></script>
<script src="<?php echo $slash; ?>js/slick.js"></script>
<script type="text/javascript">var webpage_full_link = '<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url = '<?php echo $LOGIN_URL;?>';</script>
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash; ?>js/custom_validation.js"></script>
<script>
$('.multiple-items1').slick({
        dots: true,
        arrows: false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 992,
            settings: {
                dots: false,
                arrows: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }]

    });

//    <!--Product Enquiry Form Detail Page Ajax Call And Validation starts-->
    $("#product_detail_enquiry_submit").click(function() {
        $("#product_detail_enquiry_form").validate({
            rules: {
                enquiry_name: {required: true},
                enquiry_email: {required: true, email: true},
                enquiry_mobile: {required: true}

            },
            messages: {

                enquiry_name: {required: "Name is Required"},
                enquiry_email: {required: "Email ID is Required"},
                enquiry_mobile: {required: "Mobile Number is Required"}
            },

            submitHandler: function (form) { // for demo
                //form.submit();
                $.ajax({
                    type: "POST",
                    data: $("#product_detail_enquiry_form").serialize(),
                    url: "<?php echo $slash; ?>enquiry_submit.php",
                    cache: true,
                    success: function (html) {
                         //alert(html);
                       // console.log(html);
                        if (html == 1) {
                            $("#product_detail_enq_success").show();
                            $("#product_detail_enquiry_form")[0].reset();
                        } else {
                            if (html == 3) {
                                $("#product_detail_enq_same").show();
                                $("#product_detail_enquiry_form")[0].reset();
                            }else {
                                $("#product_detail_enq_fail").show();
                                $("#product_detail_enquiry_form")[0].reset();
                            }
                        }

                    }

                })
            }
        });
    });
    <!--Product Enquiry Form Detail Page Ajax Call And Validation ends-->

</script>
</body>

</html>