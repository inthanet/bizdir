/**
 * Created by Vignesh on 10/06/2023.
 */

//Listing Filter Script Starts


// $("input[type='checkbox'], input[type='radio']").on( "click", listingFilter() );
// $("select").on( "change", listingFilter() );

// <!--    Listing Filter Script Starts-->

$('.listing-filters-span').on('click', function () {
    var value = this.id;
    var type = $(this).attr("data-type");
    var current_url = $(location).attr('href');

    var href = new URL(current_url);

    if (type == 'category') {

        var cat_key = href.searchParams.get('category');

        if(cat_key == null) {

            var new_value = "/"+value;
            var new_url = current_url.replace(new_value, '');

        }else {
            var new_url = current_url.replace(value, '');

        }
    }

    if (type == 'sub_cat') {
        var sub_cat_all = href.searchParams.get('subcategory');

        if (sub_cat_all.indexOf(value + ',') != -1) {

            var new_url = current_url.replace(value + ',', '');

        } else {
            var new_url = current_url.replace(value, '');
        }
    }

    if (type == 'city') {
        var city_all = href.searchParams.get('city');

        if (city_all.indexOf(value + ',') != -1) {

            var new_url = current_url.replace(value + ',', '');

        } else {
            var new_url = current_url.replace(value, '');
        }
    }

    if (type == 'feature') {
        var feature_all = href.searchParams.get('feature');

        if (feature_all.indexOf(value + ',') != -1) {

            var new_url = current_url.replace(value + ',', '');

        } else {
            new_url = current_url.replace(value, '');
        }
    }

    if (type == 'ratings') {

        var new_url = current_url.replace(value, '0');
    }

    document.location.href = new_url;

});

$(".city_check, .sub_cat_check ,.rating_check, .feature_check, .lfv2-all, .lfv2-pop, .lfv2-op, .lfv2-tru, .lfv2-near, .lfv2-off").on( "click", listingFilter );
$("select").on( "change", listingFilter );


function listingFilter() {

    // $(".all-listing-total").css("opacity",0);


    var mainarray = [];

    // var size = [];
    // $('input[name="scheck"]:checked').each(function(){
    //     size.push($(this).val());
    //     $('.spansizecls').css('visibility','visible');
    // });
    // if(size=='') $('.spansizecls').css('visibility','hidden');
    // var size_checklist = "&scheck="+size;

    //To get Category values from All listing page starts

    var cat_check = [];
    $('#cat_check :selected').each(function(){
        // $('input[name="cat_check"]:checked').each(function(){
        cat_check.push($(this).val());
    });

    var cat_checklist = "&category="+cat_check;

    //To get Category values from All listing page ends


   //To get Sub category values from All listing page starts

    var sub_cat_check = [];
    $('input[name="sub_cat_check"]:checked').each(function(){
        sub_cat_check.push($(this).val());

    });

    var sub_cat_checklist = "&subcategory="+sub_cat_check;

    //To get Sub category values from All listing page ends

    //To get Feature values from All listing page starts

    var feature_check = [];
    $('input[name="feature_check"]:checked').each(function(){
        feature_check.push($(this).val());

    });

    var feature_checklist = "&feature="+feature_check;

    //To get Feature values from All listing page ends

    var city_check = [];
    $('#city_check :selected').each(function(){
        // $('input[name="cat_check"]:checked').each(function(){
        city_check.push($(this).val());
    });
    var city_checklist = "&city="+city_check;

    //To get Rating values from All listing page starts

    var rating_check = [];
    $('input[name="rating_check"]:checked').each(function(){
        rating_check.push($(this).val());
    });
    var rating_checklist = "&ratings="+rating_check;

    //To get Rating values from All listing page ends

    //Top Filter All Option from All listing page starts

    var lfv2_all_check = [];
    $('input[name="lfv2-all"]:checked').each(function(){

        lfv2_all_check.push($(this).val());

    });

    var lfv2_all_checklist = "&lfv2_all_check="+lfv2_all_check;

    //Top Filter All Option from All listing page ends

    //Top Filter Popular Option from All listing page starts

    var lfv2_pop_check = [];
    $('input[name="lfv2-pop"]:checked').each(function(){
        lfv2_pop_check.push($(this).val());

    });

    var lfv2_pop_checklist = "&lfv2_pop_check="+lfv2_pop_check;

    //Top Filter Popular Option from All listing page ends

    //Top Filter Open Option from All listing page starts

    var lfv2_op_check = [];
    $('input[name="lfv2-op"]:checked').each(function(){
        lfv2_op_check.push($(this).val());

    });

    var lfv2_op_checklist = "&lfv2_op_check="+lfv2_op_check;

    //Top Filter Open Option from All listing page ends

    //Top Filter Trusted Option from All listing page starts

    var lfv2_tru_check = [];
    $('input[name="lfv2-tru"]:checked').each(function(){
        lfv2_tru_check.push($(this).val());

    });

    var lfv2_tru_checklist = "&lfv2_tru_check="+lfv2_tru_check;

    //Top Filter Trusted Option from All listing page ends

    //Top Filter NearBy Option from All listing page starts

    var lfv2_near_check = [];
    $('input[name="lfv2-near"]:checked').each(function(){
        lfv2_near_check.push($(this).val());

    });

    var lfv2_near_checklist = "&lfv2_near_check="+lfv2_near_check;

    //Top Filter NearBy Option from All listing page ends

    //Top Filter Offer Option from All listing page starts

    var lfv2_offer_check = [];
    $('input[name="lfv2-off"]:checked').each(function(){
        lfv2_offer_check.push($(this).val());

    });

    var lfv2_offer_checklist = "&lfv2_offer_check="+lfv2_offer_check;

    //Top Filter Offer Option from All listing page ends


    // var main_string = cat_checklist+sub_cat_checklist+rating_checklist+city_checklist
    //                   +feature_checklist+lfv2_all_checklist +lfv2_pop_checklist +lfv2_op_checklist
    //                   +lfv2_tru_checklist+lfv2_near_checklist +lfv2_offer_checklist;

    var main_string = cat_checklist+sub_cat_checklist+rating_checklist+city_checklist
        +feature_checklist;

    main_string = main_string.substring(1, main_string.length);
   // $('#loadingmessage').show();  // show the loading message.

    if(webpage_full_link !== null){
        var link = webpage_full_link +'all-listing';
    }else{
        var link = 'all-listing';
    }

    window.location.href = link + '?' + main_string;

    // $.ajax({
    //     type: "POST",
    //     url: link,
    //     data: main_string ,
    //     cache: false,
    //     success: function(html){
    //         //alert(html);
    //         $(".all-listing-total").html(html);
    //         $(".all-listing-total").css("opacity",1);
    //         // $("#loaderID").css("opacity",0);
    //         $('#loadingmessage').hide(); // hide the loading message
    //         listings_paginate();
    //     }
    // });


}

// <!--    Listing Page Filter Script Ends-->