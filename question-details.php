<?php
include "header.php";

if (file_exists('config/places_page_authentication.php')) {
    include('config/places_page_authentication.php');
}

?>
<style>
    .hom-head .container {
        display: none
    }

    .hom-top {
        transition: all .5s ease;
        background: #000;
        box-shadow: none
    }

    .hom-head {
        background: none !important;
        padding: 0;
        margin: 0
    }

    .hom-head .hom-top .container {
        display: block
    }

    .hom-top {
        background: #292c2e;
    }
</style>
<!--START-->
<section>
    <div class="que-deti-main">
        <div class="container">
            <div class="row">
                <div class="que-deti-links">
                <span class="que-mob-nav"><i class="material-icons">menu</i> Navigate</span>
                    <div class="inn">
                    <h4>Navigate</h4>
                    <ul>
                        <li><a href="question-index">Home</a></li>
                        <li><a href="question-index?tab=myposts">My posts</a></li>
                        <li><a href="">All questions</a></li>
                        <li><a href="question-index">Latest</a></li>
                        <li><a href="question-index?tab=trending">Trending</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#poptags">Tags</a></li>
                        <li><a href="community" target="_blank">Users</a></li>
                        <li><a href="jobs/" target="_blank">Job openings</a></li>
                    </ul>
                    <a href="#" data-toggle="modal" data-target="#addplacepop" class="que-cta-ask">Ask question</a>
                    </div>
                </div>
                <div class="que-deti-full">
                    <div class="que-deti-tit">
                        <h1>PHP OOP best practice: Load different version of class function depending on condition</h1>
                        <div class="que-deti-ans-bio">
                            <div class="que-pro-sort">
                                <img src="images/user/396282.jpg" alt="">
                                <div>
                                    <h4>John smith</h4>
                                    <p>Web deveoper</p>
                                </div>
                                <a href="profile/rn53" class="fclick" target="_blank"></a>
                            </div>
                            <div class="que-deti-ans-deti">
                                Posted on <b>12 June 2023</b>
                            </div>
                            <div class="que-deti-like">
                                <span class="que-like" data-toggle="tooltip" data-placement="top" title="Likes"><i class="material-icons">thumb_up</i> 12</span>
                                <span class="que-dislike" data-toggle="tooltip" data-placement="top" title="Dislike"><i class="material-icons">thumb_down</i> 6</span>
                                <span class="que-ans" data-toggle="tooltip" data-placement="top" title="Answers"><i class="material-icons">verified_user</i> 12</span>
                                <span class="que-qviews" data-toggle="tooltip" data-placement="top" title="Views"><i class="material-icons">visibility</i> 862</span>
                            <span class="que-shar" data-toggle="modal" data-target="#sharepop"><i class="material-icons">share</i> Share</span>
                            </div>
                        </div>
                    </div>
                    <div class="que-deti-desc">
                        <p>I'm building a payment gateway class that will work with different gateways. First I load the standard class with shared functionality. Then I want to load different versions of functions depending on which gateway is used. The var deciding which version should be used is the $gatewayCode var, which in this case could have values paypal or stripe, which then would load Gateway.PayPal.php or Gateway.Stripe.php.</p>
                    </div>
                    <div class="que-deti-ans-post">
                        <h4>Start sharing your comments</h4>
                        <a href="#" data-toggle="modal" data-target="#popwritecomm" class="que-cta-writ-comm">Write comments</a>
                    </div>
                    <div class="que-deti-ans">
                        <span class="que-ans-list">Comment 1</span>
                        <p>I would build it against interfaces. Maybe rename it to something like PaymentService (but that is just personal preference and it allows your concrete class to represent the gateway type), then each gateway implement the GatewayInterface. </p>
                        <div class="que-deti-ans-bio">
                            <div class="que-deti-like">
                                <span class="que-like"><i class="material-icons">thumb_up</i>2 Like</span>
                                <span class="que-dislike"><i class="material-icons">thumb_down</i> 1 Dislike</span>
                            </div>
                            <div class="que-deti-ans-deti">
                                Posted on <b>12 June 2023</b>
                            </div>
                            <div class="que-pro-sort">
                                <img src="images/user/396282.jpg" alt="">
                                <div>
                                    <h4>John smith</h4>
                                    <p>Web deveoper</p>
                                </div>
                                <a href="profile/rn53" class="fclick" target="_blank"></a>
                            </div>
                        </div>
                    </div>
                    <div class="que-deti-ans">
                        <span class="que-ans-list">Comment 2</span>
                        <p>I would build it against interfaces. Maybe rename it to something like PaymentService (but that is just personal preference and it allows your concrete class to represent the gateway type), then each gateway implement the GatewayInterface. </p>
                        <div class="que-deti-ans-bio">
                            <div class="que-deti-like">
                                <span class="que-like"><i class="material-icons">thumb_up</i> 10 Like</span>
                                <span class="que-dislike"><i class="material-icons">thumb_down</i> 2 Dislike</span>
                            </div>
                            <div class="que-deti-ans-deti">
                                Posted on <b>12 June 2023</b>
                            </div>
                            <div class="que-pro-sort">
                                <img src="images/user/396282.jpg" alt="">
                                <div>
                                    <h4>John smith</h4>
                                    <p>Web deveoper</p>
                                </div>
                                <a href="profile/rn53" class="fclick" target="_blank"></a>
                            </div>
                        </div>
                    </div>

                    <!-- START -->
                    <div class="que-hom-all">
                        <h3>Related posts</h3>
                        <div class="tab-content">
                        <ul>
                        <li>
                            <div class="que-box-1">
                                <div class="que-pro">
                                    <img src="images/user/68128pexels-photo-91227.jpeg" alt="">
                                </div>
                                <div class="que">
                                    <h4>Iphone 14 launch date release</h4>
                                    <div class="que-has">
                                        <span>#iphone</span>
                                        <span>#iphone14</span>
                                        <span>#iphone new</span>
                                    </div>
                                    <div class="que-deti-like">
                                            <span class="que-like" data-toggle="tooltip" data-placement="top" title="Likes"><i class="material-icons">thumb_up</i> 12</span>
                                            <span class="que-dislike" data-toggle="tooltip" data-placement="top" title="Dislike"><i class="material-icons">thumb_down</i> 6</span>
                                            <span class="que-qviews" data-toggle="tooltip" data-placement="top" title="Views"><i class="material-icons">visibility</i> 862</span>
                                        </div>
                                </div>
                                <a href="#" class="fclick"></a>
                            </div>
                        </li>
                        <li>
                            <div class="que-box-1">
                                <div class="que-pro">
                                    <img src="images/user/396282.jpg" alt="">
                                </div>
                                <div class="que">
                                    <h4>How to update windows 10 to 11?</h4>
                                    <div class="que-has">
                                        <span>#windows11</span>
                                        <span>#Windows update</span>
                                        <span>#Windows</span>
                                    </div>
                                    <div class="que-deti-like">
                                            <span class="que-like" data-toggle="tooltip" data-placement="top" title="Likes"><i class="material-icons">thumb_up</i> 12</span>
                                            <span class="que-dislike" data-toggle="tooltip" data-placement="top" title="Dislike"><i class="material-icons">thumb_down</i> 6</span>
                                            <span class="que-qviews" data-toggle="tooltip" data-placement="top" title="Views"><i class="material-icons">visibility</i> 862</span>
                                        </div>
                                </div>
                                <a href="#" class="fclick"></a>
                            </div>
                        </li>
                        <li>
                            <div class="que-box-1">
                                <div class="que-pro">
                                    <img src="images/user/68128pexels-photo-91227.jpeg" alt="">
                                </div>
                                <div class="que">
                                    <h4>Iphone 14 launch date release</h4>
                                    <div class="que-has">
                                        <span>#iphone</span>
                                        <span>#iphone14</span>
                                        <span>#iphone new</span>
                                    </div>
                                    <div class="que-deti-like">
                                            <span class="que-like" data-toggle="tooltip" data-placement="top" title="Likes"><i class="material-icons">thumb_up</i> 12</span>
                                            <span class="que-dislike" data-toggle="tooltip" data-placement="top" title="Dislike"><i class="material-icons">thumb_down</i> 6</span>
                                            <span class="que-qviews" data-toggle="tooltip" data-placement="top" title="Views"><i class="material-icons">visibility</i> 862</span>
                                        </div>
                                </div>
                                <a href="#" class="fclick"></a>
                            </div>
                        </li>
                        <li>
                            <div class="que-box-1">
                                <div class="que-pro">
                                    <img src="images/user/396282.jpg" alt="">
                                </div>
                                <div class="que">
                                    <h4>How to update windows 10 to 11?</h4>
                                    <div class="que-has">
                                        <span>#windows11</span>
                                        <span>#Windows update</span>
                                        <span>#Windows</span>
                                    </div>
                                    <div class="que-deti-like">
                                            <span class="que-like" data-toggle="tooltip" data-placement="top" title="Likes"><i class="material-icons">thumb_up</i> 12</span>
                                            <span class="que-dislike" data-toggle="tooltip" data-placement="top" title="Dislike"><i class="material-icons">thumb_down</i> 6</span>
                                            <span class="que-qviews" data-toggle="tooltip" data-placement="top" title="Views"><i class="material-icons">visibility</i> 862</span>
                                        </div>
                                </div>
                                <a href="#" class="fclick"></a>
                            </div>
                        </li>
                    </ul>
                        </div>
                    </div>
                    <!-- END -->
                </div>
                <div class="que-hom-rhs">
                
                    <div class="job-rel-pro">
                        <div class="hot-page2-hom-pre">
                            <h4>Related posts</h4>
                            <ul>
                                <li>
                                    <div class="hot-page2-hom-pre-2">
                                        <h5>How to update windows 10 to 11?</h5>
                                        <span>by <b>John smith</b>, on <b>Web development</b></span>
                                    </div>
                                    <a href="http://localhost/bizbook/all-service-experts/laptop-service" class="fclick"></a>
                                </li>
                                <li>
                                    <div class="hot-page2-hom-pre-2">
                                        <h5>How to update windows 10 to 11?</h5>
                                        <span>by <b>John smith</b>, on <b>Web development</b></span>
                                    </div>
                                    <a href="http://localhost/bizbook/all-service-experts/laptop-service" class="fclick"></a>
                                </li>
                                <li>
                                    <div class="hot-page2-hom-pre-2">
                                        <h5>How to update windows 10 to 11?</h5>
                                        <span>by <b>John smith</b>, on <b>Web development</b></span>
                                    </div>
                                    <a href="http://localhost/bizbook/all-service-experts/laptop-service" class="fclick"></a>
                                </li>
                                <li>
                                    <div class="hot-page2-hom-pre-2">
                                        <h5>How to update windows 10 to 11?</h5>
                                        <span>by <b>John smith</b>, on <b>Web development</b></span>
                                    </div>
                                    <a href="http://localhost/bizbook/all-service-experts/laptop-service" class="fclick"></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="ud-rhs-promo ud-rhs-promo-que">
                        <!-- BEFORE REGISTER -->
                        <h3>Post your Question?</h3>
                        <p>Register now and post your question here.</p>
                        <a href="login">Register for free</a>

                        <!-- AFTER REGISTER -->
                        <p>Find the best answer to your question or doubts, help others answer theirs</p>
                        <span data-toggle="modal" data-target="#addplacepop" class="que-cta-ask">Ask a question</span>
                    </div>

                    <div class="job-rel-pro">
                        <div class="hot-page2-hom-pre">
                            <h4>Popular tags</h4>
                            <div class="que-has">
                                <a href="#">#windows11</a>
                                <a href="#">#iphone</a>
                                <a href="#">#lenovo</a>
                                <a href="#">#html5</a>
                                <a href="#">#animation</a>
                                <a href="#">#seo</a>
                                <a href="#">#windows11</a>
                                <a href="#">#iphone</a>
                                <a href="#">#lenovo</a>
                            </div>
                            <span class="alltagshow" data-toggle="modal" data-target="#poptags">More tags</span>
                        </div>
                    </div>
                    
                    <div class="job-rel-pro">
                        <div class="hot-page2-hom-pre que-rhs-oth-post">
                            <h4><b>John smith</b> Other posts</h4>
                            <ul>
                                <li>
                                    <div class="hot-page2-hom-pre-2">
                                        <h5>How to update windows 10 to 11?</h5>
                                        <span><b>Web development</b></span>
                                    </div>
                                    <a href="http://localhost/bizbook/all-service-experts/laptop-service" class="fclick"></a>
                                </li>
                                <li>
                                    <div class="hot-page2-hom-pre-2">
                                        <h5>How to update windows 10 to 11?</h5>
                                        <span><b>Web development</b></span>
                                    </div>
                                    <a href="http://localhost/bizbook/all-service-experts/laptop-service" class="fclick"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!--END-->


<!-- COMMENT POPUP -->
<div class="pop-ups pop-que">
        <!-- The Modal -->
        <div class="modal fade" id="popwritecomm">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="log-bor">&nbsp;</div>
                    <span class="udb-inst">Post your comments</span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="quote-pop">
                        <h4>Post your comments</h4>
                        <div id="place_pop_enq_success" class="log" style="display: none;">
                            <p><?php echo $BIZBOOK['PLACE_ADD_SUCCESSFUL_MESSAGE']; ?></p>
                        </div>
                        <div id="place_pop_enq_fail" class="log" style="display: none;">
                            <p><?php echo $BIZBOOK['OOPS_SOMETHING_WENT_WRONG']; ?></p>
                        </div>
                        <form method="post" name="place_add_request_form" id="place_add_request_form" class="place_add_request_form">
                            <input type="hidden" class="form-control"
                                   name="enquiry_sender_id"
                                   value="<?php echo $session_user_id; ?>"
                                   placeholder=""
                                   required>
                            <div class="form-group">
                                <textarea cols="30" rows="10" id="ques_post_comm" name="ques_post_comm"></textarea>
                            </div>
                            <input type="hidden" id="source">
                            <button <?php if ($session_user_id == NULL || empty($session_user_id)) {
                                ?> disabled="disabled" <?php } ?> type="submit" id="place_add_request_submit"  name="place_add_request_submit" class="cta_submit_green btn btn-primary"><?php if ($session_user_id == NULL || empty($session_user_id)) {
                                    ?> <?php echo $BIZBOOK['LOG_IN_TO_SUBMIT'];?> <?php }else{ ?><?php echo $BIZBOOK['SUBMIT']; ?> <?php }?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<!-- AL TAGS POPUP -->
<div class="pop-ups pop-que">
        <!-- The Modal -->
        <div class="modal fade" id="poptags">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="log-bor">&nbsp;</div>
                    <span class="udb-inst">All tags</span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="quote-pop">
                        <div class="que-has">
                                <a href="#">#windows11</a>
                                <a href="#">#iphone</a>
                                <a href="#">#lenovo</a>
                                <a href="#">#html5</a>
                                <a href="#">#animation</a>
                                <a href="#">#seo</a>
                                <a href="#">#windows11</a>
                                <a href="#">#iphone</a>
                                <a href="#">#lenovo</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
</div>

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
                        Copy text
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- POST QUESTION POPUP -->
<div class="pop-ups">
        <!-- The Modal -->
        <div class="modal fade" id="addplacepop">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="log-bor">&nbsp;</div>
                    <span class="udb-inst">Ask Question</span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="quote-pop">
                        <h4>Post your question</h4>
                        <div id="place_pop_enq_success" class="log" style="display: none;">
                            <p><?php echo $BIZBOOK['PLACE_ADD_SUCCESSFUL_MESSAGE']; ?></p>
                        </div>
                        <div id="place_pop_enq_fail" class="log" style="display: none;">
                            <p><?php echo $BIZBOOK['OOPS_SOMETHING_WENT_WRONG']; ?></p>
                        </div>
                        <form method="post" name="place_add_request_form" id="place_add_request_form" class="place_add_request_form">
                            <input type="hidden" class="form-control"
                                   name="enquiry_sender_id"
                                   value="<?php echo $session_user_id; ?>"
                                   placeholder=""
                                   required>
                            <div class="form-group">
                                <input type="text" name="place_name" class="form-control" placeholder="Question" required>
                            </div>
                            <div class="form-group">
                                <select class="chosen-select" data-placeholder="Select category">
                                    <option value="0">Select category</option>
                                    <option value="1">Technology</option>
                                    <option value="2">History</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="chosen-select" data-placeholder="Choose a #tags"  multiple>
                                    <option value="1">Technology</option>
                                    <option value="2">History</option>
                                    <option value="3">Technology</option>
                                    <option value="4">History</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="ques_ask" placeholder="Descriptions"></textarea>
                            </div>
                            <input type="hidden" id="source">
                            <button <?php if ($session_user_id == NULL || empty($session_user_id)) {
                                ?> disabled="disabled" <?php } ?> type="submit" id="place_add_request_submit"  name="place_add_request_submit" class="cta_submit_green btn btn-primary"><?php if ($session_user_id == NULL || empty($session_user_id)) {
                                    ?> <?php echo $BIZBOOK['LOG_IN_TO_SUBMIT'];?> <?php }else{ ?><?php echo $BIZBOOK['SUBMIT']; ?> <?php }?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<?php
include "footer.php";
?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $slash; ?>js/jquery.min.js"></script>
<script src="<?php echo $slash; ?>js/popper.min.js"></script>
<script src="<?php echo $slash; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash; ?>js/jquery-ui.js"></script>
<script src="<?php echo $slash; ?>js/select-opt.js"></script>
<script type="text/javascript">var webpage_full_link ='<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url ='<?php echo $LOGIN_URL;?>';</script>
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash; ?>js/custom_validation.js"></script>
<script src="<?php echo $slash; ?>admin/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('ques_post_comm');
    CKEDITOR.replace('ques_ask');
</script>
<script>
    $(document).ready(function(){
        $(".que-deti-like i").click(function(){
            $(this).addClass("act");
            setTimeout(function (){
                $(".que-deti-like i").removeClass("act");
            }, 1000);
        });
    });
</script>
</body>

</html>