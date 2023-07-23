<?php
if ($current_home_page == '4' || $current_home_page == '5' || $current_home_page == '6' || $current_home_page == '7' || $current_home_page == '8' || $current_home_page == '9') {
    ?>
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
        $('.multiple-items, .multiple-items1').slick({
            infinite: true,
            slidesToShow: 4,
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

        <?php
        if ($current_home_page == '5') {
        ?>
        (function(){
            var words = [
                'Property',
                'Plots',
                'Villas',
                'Apartment'
            ], i = 0;
            setInterval(function(){
                $('#changingword').fadeOut(function(){
                    $(this).html(words[i=(i+1)%words.length]).fadeIn();
                });
            }, 1500);

        })();
        <?php } ?>

    </script>
    <?php
}
?>
<script>
    function getSearchCategories(val) {
        var new_class = '';
        if(val == 1){
             new_class = "ban-search ban-sear-all ser-oly-listing";
        }else if(val == 2){
             new_class = "ban-search ban-sear-all ser-oly-expert";
        }else if(val == 3){
             new_class = "ban-search ban-sear-all ser-oly-job";
        }else if(val == 4){
             new_class = "ban-search ban-sear-all ser-oly-place";
        }else if(val == 5){
             new_class = "ban-search ban-sear-all ser-oly-news";
        }else if(val == 6){
             new_class = "ban-search ban-sear-all ser-oly-event";
        }else if(val == 7){
             new_class = "ban-search ban-sear-all ser-oly-product";
        }else if(val == 8){
             new_class = "ban-search ban-sear-all ser-oly-coupon";
        }else if(val == 9){
            new_class = "ban-search ban-sear-all ser-oly-blog";
        }else{
            new_class = "ban-search ban-sear-all";
        }

        $('.sr-cate').parents('.ban-search').removeClass().addClass(new_class);

        getSearchCities(val);
        $.ajax({
            type: "POST",
            url: "search_category_process.php",
            data: 'type_id=' + val,
            success: function (data) {
                $("#expert-select-search").html(data);
                $('#expert-select-search').trigger("chosen:updated");
            }
        });
    }
    function getSearchCities(val) {
        $.ajax({
            type: "POST",
            url: "search_city_process.php",
            data: 'type_id=' + val,
            success: function (data) {
                $("#city_check").html(data);
                $('#city_check').trigger("chosen:updated");
            }
        });
    }
</script>
