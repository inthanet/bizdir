/**
 * Created by Vignesh on 10/06/2023.
 */

<!--    product Filter Script Starts-->


// $("input[type='checkbox'], input[type='radio']").on( "click", productFilter() );
// $("select").on( "change", productFilter() );


// <!--    product Filter Script Starts-->

$('.product-filters-span').on('click', function () {
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

    if (type == 'price') {

        var price_all = href.searchParams.get('price');

        if (price_all.indexOf(value + ',') != -1) {

            var new_url = current_url.replace(value + ',', '');

        } else {
            var new_url = current_url.replace(value, '');
        }
    }

    if (type == 'discount') {

        var discount_all = href.searchParams.get('discount');

        if (discount_all.indexOf(value + ',') != -1) {

            var new_url = current_url.replace(value + ',', '');

        } else {
            new_url = current_url.replace(value, '');
        }
    }

    document.location.href = new_url;

});

$(".city_check, .sub_cat_check ,.discount_check, .price_check").on( "click", productFilter );
$("select").on( "change", productFilter );


function productFilter() {

    $(".all-product-total").css("opacity",0);


    var mainarray = [];

    var size = [];
    $('input[name="scheck"]:checked').each(function(){
        size.push($(this).val());
        $('.spansizecls').css('visibility','visible');
    });
    if(size=='') $('.spansizecls').css('visibility','hidden');
    var size_checklist = "&scheck="+size;

    //To get Category values from All product page starts

    var cat_check = [];
    $('#cat_check :selected').each(function(){
        // $('input[name="cat_check"]:checked').each(function(){
        cat_check.push($(this).val());
    });

    var cat_checklist = "&category="+cat_check;

    //To get Category values from All product page ends


    //To get Sub category values from All product page starts

    var sub_cat_check = [];
    $('input[name="sub_cat_check"]:checked').each(function(){
        sub_cat_check.push($(this).val());

    });

    var sub_cat_checklist = "&subcategory="+sub_cat_check;

    //To get Sub category values from All product page ends

    //To get Feature values from All product page starts

    var price_check = [];
    $('input[name="price_check"]:checked').each(function(){
        price_check.push($(this).val());

    });

    var price_checklist = "&price="+price_check;

    //To get Feature values from All product page ends

    var city_check = [];
    $('input[name="city_check"]:checked').each(function(){
        city_check.push($(this).val());

    });
    var city_checklist = "&city_check="+city_check;


    //To get Rating values from All product page starts

    var discount_check = [];
    $('input[name="discount_check"]:checked').each(function(){
        discount_check.push($(this).val());
    });
    var discount_checklist = "&discount="+discount_check;

    //To get Rating values from All product page ends


    var main_string = cat_checklist+sub_cat_checklist+discount_checklist+price_checklist;
    main_string = main_string.substring(1, main_string.length);


    if(webpage_full_link != null){
        var link = webpage_full_link +'all-products';
    }else{
        var link = 'all-products';
    }

    window.location.href = link + '?' + main_string;

    // $.ajax({
    //     type: "POST",
    //     url: link,
    //     data: main_string ,
    //     cache: false,
    //     success: function(html){
    //         //alert(html);
    //         $(".all-product-total").html(html);
    //         $(".all-product-total").css("opacity",1);
    //         // $("#loaderID").css("opacity",0);
    //         products_paginate();
    //     }
    // });


}

<!--    Product Page Filter Script Ends-->


