/**
 * Created by Vignesh on 20/04/2023.
 */

// <!--    Blog Filter Script Starts-->

$('.blog-filters-span').on('click', function () {
    var value = this.id;
    var type = $(this).attr("data-type");
    var current_url = $(location).attr('href');

    var href = new URL(current_url);
    if (type == 'category') {
        href.searchParams.set('category', '');
    }
    if (type == 'sort_by') {
        href.searchParams.set('sort_by', '');
    }

    document.location.href = href.toString();

});

$(".cat_check, .sort_by").on("change", blogFilter);

function blogFilter() {

    // $(".all-blog-total").css("opacity",0);

    var mainarray = [];

    //To get Category values from All blog page starts

    var cat_check = [];
    $('#cat_check :selected').each(function () {
        cat_check.push($(this).val());
    });

    var cat_checklist = "&category=" + cat_check;

    //To get Category values from All blog page ends

    //To get Sort values from All blog page starts

    var blog_ser_cou = [];
    $('#sort_by :selected').each(function () {
        blog_ser_cou.push($(this).val());
    });
    var blog_ser_cou_list = "&sort_by=" + blog_ser_cou;

    //To get Sort values from All blog page ends

    var main_string = cat_checklist + blog_ser_cou_list;
    main_string = main_string.substring(1, main_string.length);

    var link = 'blog-posts';

    if (webpage_full_link !== null) {
        link = webpage_full_link + 'blog-posts';
    }

    window.location.href = link + '?' + main_string;
}

// <!--    blog Page Filter Script Ends-->