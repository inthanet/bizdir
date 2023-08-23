<?php
include "header.php";
?>
<!-- START -->
<section class="abou-pg abou-pg1">
    <div class="about-ban">
        <h1><?php echo $BIZBOOK['ADS_HEADLINE']; ?></h1>
        <p><?php echo $BIZBOOK['ADS_SUBHEADLINE']; ?></p>
    </div>
    <div class="container">
        <div class="row">
            <div class="about-ads">
                <p><b><?php echo $BIZBOOK['ADS_INTRO_HL']; ?></b></p>
                <p><?php echo $BIZBOOK['ADS_INTRO_1']; ?></p>
                <p><?php echo $BIZBOOK['ADS_INTRO_2']; ?></p>
                <p><?php echo $BIZBOOK['ADS_INTRO_3']; ?></p>
                <p><?php echo $BIZBOOK['ADS_INTRO_4']; ?></p>
                <p><?php echo $BIZBOOK['ADS_INTRO_5']; ?></p>
                <p><?php echo $BIZBOOK['ADS_INTRO_6']; ?></p>
            </div>
            
            <div class="how-wrks">
                <div class="home-tit">
                    <h2><span><?php echo $BIZBOOK['ADS_HOW_TIT']; ?></span></h2>
                    <h4><?php echo $BIZBOOK['ADS_HOW_SUB_TIT']; ?></h4>
                </div>
                <div style="margin-top:20px; width:100%;text-align:center;">
                   <p><?php echo $BIZBOOK['ADS_HOW_TXT_1']; ?></p>
                </div> 

                <div class="how-wrks-inn">
                    <ul>
                        <li>
                            <div>
                                <img loading="lazy" src="images/icon/how1.png" alt="">
                                <h4><?php echo $BIZBOOK['pg_abo_why_s1_tit']; ?></h4>
                                <p><?php echo $BIZBOOK['pg_abo_why_s1_sub']; ?></p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img loading="lazy" src="images/icon/how2.png" alt="">
                                <h4><?php echo $BIZBOOK['pg_abo_why_s2_tit']; ?></h4>
                                <p><?php echo $BIZBOOK['pg_abo_why_s2_sub']; ?></p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img loading="lazy" src="images/icon/how3.png" alt="">
                                <h4><?php echo $BIZBOOK['pg_abo_why_s3_tit']; ?></h4>
                                <p><?php echo $BIZBOOK['pg_abo_why_s3_sub']; ?></p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img loading="lazy" src="images/icon/how4.png" alt="">
                                <h4><?php echo $BIZBOOK['pg_abo_why_s4_tit']; ?></h4>
                                <p><?php echo $BIZBOOK['pg_abo_why_s4_sub']; ?></p>
                            </div>
                        </li>
                    </ul>
                </div>
                
            </div>
            <div style="margin-top:20px; width:100%;text-align:center;">
               <p><?php echo $BIZBOOK['ADS_HOW_TXT_2']; ?></p>
               <p style="color:orange;"><?php echo $BIZBOOK['ADS_SUPPORT']; ?></p>
            </div>


            <div class="how-wrks">
                <div class="home-tit">
                    <h2><span><?php echo $BIZBOOK['ADS_HOWMUCH_TIT']; ?></span></h2>
                    <h4><?php echo $BIZBOOK['ADS_HOWMUCH_SUB_TIT']; ?></h4>
                </div>
                <div style="margin-top:20px; width:100%;text-align:center;">
                   <p><?php echo $BIZBOOK['ADS_HOWMUCH_TXT_1']; ?></p>
                   <h4><?php echo $BIZBOOK['ADS_HOWMUCH_YOU_GET']; ?></h4>
                </div>                 
                
                <div class="how-wrks-inn">
                    <ul>
                        <li>
                            <div>
                                <img loading="lazy" src="images/icon/how1.png" alt="">
                                <h4><?php echo $BIZBOOK['pg_abo_why_s1_tit']; ?></h4>
                                <p><?php echo $BIZBOOK['pg_abo_why_s1_sub']; ?></p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img loading="lazy" src="images/icon/how2.png" alt="">
                                <h4><?php echo $BIZBOOK['pg_abo_why_s2_tit']; ?></h4>
                                <p><?php echo $BIZBOOK['pg_abo_why_s2_sub']; ?></p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img loading="lazy" src="images/icon/how3.png" alt="">
                                <h4><?php echo $BIZBOOK['pg_abo_why_s3_tit']; ?></h4>
                                <p><?php echo $BIZBOOK['pg_abo_why_s3_sub']; ?></p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <img loading="lazy" src="images/icon/how4.png" alt="">
                                <h4><?php echo $BIZBOOK['pg_abo_why_s4_tit']; ?></h4>
                                <p><?php echo $BIZBOOK['pg_abo_why_s4_sub']; ?></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div style="margin-top:20px; width:100%;text-align:center;">
               <p style="color:orange;"><?php echo $BIZBOOK['ADS_SUPPORT']; ?></p>
            </div>            


        </div>
    </div>
</section>
<!--END-->


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
<script type="text/javascript">var webpage_full_link ='<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url ='<?php echo $LOGIN_URL;?>';</script>
<script src="js/custom.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>
</body>

</html>