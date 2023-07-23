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
<!-- START -->
<section>
    <div class="modu-hom-com-ban que-hom-ban">
        <div class="container">
            <div class="row">
                <div class="plac-hom-ban-inn">
                    <h1><?php echo $BIZBOOK['QUE-HOM-TIT']; ?></h1>
                    <p><?php echo $BIZBOOK['QUE-HOM-TIT-SUB']; ?></p>
                    <div class="plac-hom-search">
                        <div class="job-sear">
                    <form name="place_filter_form" id="place_filter_form" class="place_filter_form">
                        <ul>
                            <li class="sr-sea">
                                <select class="chosen-select" id="place-select-search" name="place-select-search">
                                    <option value="0"><?php echo $BIZBOOK['QUE-HOME-SEARCH-OPTION-1']; ?></option>
                                    <?php
                                    foreach (getAllPlaces() as $placerow) {

                                        $place_id = $placerow['place_id'];
                                        ?>
                                        <option value="<?php echo $place_id; ?>"><?php echo $placerow['place_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                    </select>
                            </li>
                            <li class="sr-btn">
                                <button id="place_filter_submit"><i class="material-icons">search</i></button>
                            </li>
                        </ul>
                    </form>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END-->

<!--START-->
<section>
    <div class="plac-hom-bd que-hom-main">
        <div class="container">
            <div class="row">
                <div class="que-hom-lhs que-hom-all">
                <ul class="nav nav-tabs">
                    <li><a data-toggle="tab" class="active" href="#tab1"><i class="material-icons">lightbulb_outline</i> All questions</a></li>
                    <li class="active"><a data-toggle="tab" href="#tab2"><i class="material-icons">layers</i> <?php echo $BIZBOOK['QUE-HOME-H-2-1']; ?></a></li>
                    <li><a data-toggle="tab" href="#tab3"><i class="material-icons">lightbulb_outline</i> Trending</a></li>
                    <li><a data-toggle="tab" href="#tab4"><i class="material-icons">perm_identity</i> My questions</a></li>
                    <li><a data-toggle="modal" data-target="#addplacepop"><i class="material-icons">record_voice_over</i> Ask question</a></li>
                    <span class="tabmov"></span>
                </ul>
                
                <div class="tab-content">
                    <!--- LATEST QUESTIONS --->
                    <div id="tab1" class="tab-pane que-hom-cate fade in active">
                    <ul>
                       <li>
                           <div class="que-hom-cate-box">
                                <h5>Jquery</h5>
                                <span class="cate-num-cunt">50</span>
                                <div class="que-cate-has">
                                    <span>#windows11</span>
                                    <span>#iphone</span>
                                    <span>#lenovo</span>
                                    <span>#html5</span>
                                    <span>#animation</span>
                                    <span>#seo</span><span>#lenovo</span>
                                    <span>#html5</span>
                                    <span>#animation</span>
                                    <span>#seo</span>
                                </div>   
                                <a href="#" class="fclick"></a>
                           </div>
                       </li>
                       <li>
                           <div class="que-hom-cate-box">
                                <h5>Digital marketing</h5>
                                <span class="cate-num-cunt">50</span>
                                <div class="que-cate-has">
                                    <span>#windows11</span>
                                    <span>#iphone</span>
                                    <span>#lenovo</span>
                                    <span>#html5</span>
                                    <span>#animation</span>
                                    <span>#seo</span><span>#lenovo</span>
                                    <span>#html5</span>
                                    <span>#animation</span>
                                    <span>#seo</span>
                                </div>   
                                <a href="#" class="fclick"></a>
                           </div>
                       </li>
                       <li>
                           <div class="que-hom-cate-box">
                                <h5>PHP</h5>
                                <span class="cate-num-cunt">50</span>
                                <div class="que-cate-has">
                                    <span>#windows11</span>
                                    <span>#iphone</span>
                                    <span>#lenovo</span>
                                    <span>#html5</span>
                                    <span>#animation</span>
                                    <span>#seo</span><span>#lenovo</span>
                                    <span>#html5</span>
                                    <span>#animation</span>
                                    <span>#seo</span>
                                </div>   
                                <a href="#" class="fclick"></a>
                           </div>
                       </li>
                       <li>
                           <div class="que-hom-cate-box">
                                <h5>Graphics</h5>
                                <span class="cate-num-cunt">50</span>
                                <div class="que-cate-has">
                                    <span>#windows11</span>
                                    <span>#iphone</span>
                                    <span>#lenovo</span>
                                    <span>#html5</span>
                                    <span>#animation</span>
                                    <span>#seo</span><span>#lenovo</span>
                                    <span>#html5</span>
                                    <span>#animation</span>
                                    <span>#seo</span>
                                </div>   
                                <a href="#" class="fclick"></a>
                           </div>
                       </li>
                       <li>
                           <div class="que-hom-cate-box">
                                <h5>HTML5</h5>
                                <span class="cate-num-cunt">50</span>
                                <div class="que-cate-has">
                                    <span>#windows11</span>
                                    <span>#iphone</span>
                                    <span>#lenovo</span>
                                    <span>#html5</span>
                                    <span>#animation</span>
                                    <span>#seo</span><span>#lenovo</span>
                                    <span>#html5</span>
                                    <span>#animation</span>
                                    <span>#seo</span>
                                </div>   
                                <a href="#" class="fclick"></a>
                           </div>
                       </li>
                   </ul>
                    </div>
                    <!--- END ---> 
                    <!--- LATEST QUESTIONS --->
                    <div id="tab2" class="tab-pane fade">
                    <ul>
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
                               <div class="que-user">
                                   by <span>John smith</span> on <span>Web design</span>
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
                               <div class="que-user">
                                   by <span>John smith</span> on <span>Web design</span>
                               </div>
                               <a href="#" class="fclick"></a>
                           </div>
                       </li>
                   </ul>
                    </div>
                    <!--- END ---> 
                    <!--- TRENDING QUESTIONS --->
                    <div id="tab3" class="tab-pane fade">
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
                               <div class="que-user">
                                   by <span>John smith</span> on <span>Web design</span>
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
                               <div class="que-user">
                                   by <span>John smith</span> on <span>Web design</span>
                               </div>
                               <a href="#" class="fclick"></a>
                           </div>
                       </li>
                   </ul>
                    </div>
                    <!--- END ---> 
                    <!--- TRENDING QUESTIONS --->
                    <div id="tab4" class="tab-pane fade">
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
                               <div class="que-user">
                                   by <span>John smith</span> on <span>Web design</span>
                               </div>
                               <!-- EDIT START -->
                               <div class="que-edit">
                                    <span data-toggle="modal" data-target="#queseditpop"><i class="material-icons">edit</i> Edit</span>
                               </div>
                               <!-- EDIT END -->
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
                               <div class="que-user">
                                   by <span>John smith</span> on <span>Web design</span>
                               </div>
                               <!-- EDIT START -->
                               <div class="que-edit">
                                    <span data-toggle="modal" data-target="#queseditpop"><i class="material-icons">edit</i> Edit</span>
                               </div>
                               <!-- EDIT END -->
                               <a href="#" class="fclick"></a>
                           </div>
                       </li>
                   </ul>
                    </div>
                    <!--- END ---> 
                </div>

                   
                </div>
                <div class="que-hom-rhs">
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
                            <h4>Trending questions</h4>
                            <ul>
                                <li>
                                        <div class="hot-page2-hom-pre-1">
                                            <img src="http://localhost/bizbook/service-experts/images/services/63410andras-vas-bd7gnnwjbku-unsplash.jpg" alt="">
                                        </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>How to update windows 10 to 11?</h5>
                                            <span>by <b>John smith</b>, on <b>Web development</b></span>
                                        </div>
                                        <a href="http://localhost/bizbook/all-service-experts/laptop-service" class="fclick"></a>
                                    </li>
                                                                        <li>
                                        <div class="hot-page2-hom-pre-1">
                                            <img src="http://localhost/bizbook/service-experts/images/services/53609pexels-blue-bird-7218013.jpg" alt="">
                                        </div>
                                        <div class="hot-page2-hom-pre-2">
                                        <h5>How to update windows 10 to 11?</h5>
                                            <span>by <b>John smith</b>, on <b>Web development</b></span>
                                        </div>
                                        <a href="http://localhost/bizbook/all-service-experts/house-decoration-services" class="fclick"></a>
                                    </li>
                                </ul>
                        </div>
                    </div>
                        
                   
                    <div class="job-rel-pro">
                        <div class="hot-page2-hom-pre">
                            <h4>Recent comments</h4>
                            <ul>
                                <li>
                                        <div class="hot-page2-hom-pre-1">
                                            <img src="http://localhost/bizbook/service-experts/images/services/63410andras-vas-bd7gnnwjbku-unsplash.jpg" alt="">
                                        </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Richetson</h5>
                                            <span>Comment on <b>How to update windows 10 to 11?</b></span>
                                        </div>
                                        <a href="http://localhost/bizbook/all-service-experts/laptop-service" class="fclick"></a>
                                    </li>
                                                                        <li>
                                        <div class="hot-page2-hom-pre-1">
                                            <img src="http://localhost/bizbook/service-experts/images/services/53609pexels-blue-bird-7218013.jpg" alt="">
                                        </div>
                                        <div class="hot-page2-hom-pre-2">
                                        <h5>Richetson</h5>
                                            <span>Comment on <b>How to update windows 10 to 11?</b></span>
                                        </div>
                                        <a href="http://localhost/bizbook/all-service-experts/house-decoration-services" class="fclick"></a>
                                    </li>
                                                                </ul>
                        </div>
                    </div>

                    <div class="job-rel-pro">
                        <div class="hot-page2-hom-pre">
                            <h4>Popular questions</h4>
                            <ul>
                                <li>
                                        <div class="hot-page2-hom-pre-1">
                                            <img src="http://localhost/bizbook/service-experts/images/services/63410andras-vas-bd7gnnwjbku-unsplash.jpg" alt="">
                                        </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>How to update windows 10 to 11?</h5>
                                            <span>by <b>John smith</b>, on <b>Web development</b></span>
                                        </div>
                                        <a href="http://localhost/bizbook/all-service-experts/laptop-service" class="fclick"></a>
                                    </li>
                                                                        <li>
                                        <div class="hot-page2-hom-pre-1">
                                            <img src="http://localhost/bizbook/service-experts/images/services/53609pexels-blue-bird-7218013.jpg" alt="">
                                        </div>
                                        <div class="hot-page2-hom-pre-2">
                                        <h5>How to update windows 10 to 11?</h5>
                                            <span>by <b>John smith</b>, on <b>Web development</b></span>
                                        </div>
                                        <a href="http://localhost/bizbook/all-service-experts/house-decoration-services" class="fclick"></a>
                                    </li>
                                                                </ul>
                        </div>
                    </div>

                    <div class="job-rel-pro">
                        <div class="hot-page2-hom-pre">
                            <h4>Popular tags</h4>
                            <div class="que-has">
                                <span>#windows11</span>
                                <a href="#">#iphone</a>
                                <a href="#">#lenovo</a>
                                <a href="#">#html5</a>
                                <a href="#">#animation</a>
                                <a href="#">#seo</a>
                                <span>#windows11</span>
                                <a href="#">#iphone</a>
                                <a href="#">#lenovo</a>
                            </div>
                            <span class="alltagshow" data-toggle="modal" data-target="#poptags">More tags</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--END-->

<!-- QUESTION POST POPUP -->
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
                                <textarea class="form-control" rows="3" id="ques_ask" placeholder="Descriptions"></textarea>
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

<!-- QUESTION POST EDIT POPUP -->
<div class="pop-ups">
        <!-- The Modal -->
        <div class="modal fade" id="queseditpop">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="log-bor">&nbsp;</div>
                    <span class="udb-inst">Edit Question</span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="quote-pop">
                        <h4>Edit your question</h4>
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
                                <textarea class="form-control" rows="3" id="ques_descrip" placeholder="Descriptions"></textarea>
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
                                <span>#windows11</span>
                                <a href="#">#iphone</a>
                                <a href="#">#lenovo</a>
                                <a href="#">#html5</a>
                                <a href="#">#animation</a>
                                <a href="#">#seo</a>
                                <span>#windows11</span>
                                <a href="#">#iphone</a>
                                <a href="#">#lenovo</a>
                            </div>
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
    CKEDITOR.replace('ques_descrip');
    CKEDITOR.replace('ques_ask');
</script>
<script>
    $(document).ready(function(){
        $(".que-hom-all ul.nav li a").click(function(){
            var _tab = $(this).position().left + "px";
            var _tabwid = $(this).outerWidth() + "px";
            $(".tabmov").css({
                "left": _tab,
                "width": _tabwid
            });
        });
        if (urlParam("tab") == "trending") {
            $(".que-hom-all ul.nav li, .que-hom-all ul.nav li a").removeClass("active");
            var _tab1 = $(".que-hom-all ul.nav li:nth-child(2) a").position().left + "px";
            var _tabwid1 = $(".que-hom-all ul.nav li:nth-child(2) a").outerWidth() + "px";
            $(".tabmov").css({
                "left": _tab1,
                "width": _tabwid1
            });
            $(".tab-pane").removeClass("in active");
            $("#tab2").addClass("in active");
        }
        if (urlParam("tab") == "myposts") {
            $(".que-hom-all ul.nav li, .que-hom-all ul.nav li a").removeClass("active");
            var _tab2 = $(".que-hom-all ul.nav li:nth-child(3) a").position().left + "px";
            var _tabwid2 = $(".que-hom-all ul.nav li:nth-child(3) a").outerWidth() + "px";
            $(".tabmov").css({
                "left": _tab2,
                "width": _tabwid2
            });
            $(".tab-pane").removeClass("in active");
            $("#tab3").addClass("in active");
        }

    });
</script>
</body>

</html>