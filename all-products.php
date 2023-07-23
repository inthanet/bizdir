<?php
include "header.php";

if ($footer_row['admin_product_show'] != 1) {
    header("Location: " . $webpage_full_link . "dashboard");
}

if (isset($_SESSION['user_id'])) {
    $session_user_id = $_SESSION['user_id'];
}
//Pagination Code Starts Here
$numberOfPages = 8;
$limit = 15;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;

//Pagination Code Ends Here

$WHERE = array();
$inner = $w = '';
$order = 'ORDER BY';

if (isset($_GET['category']) && !empty($_REQUEST['category'])) {

    $category_search_slug1 = str_replace('.php', '', $_GET['category']);

    $category_search_slug = str_replace('-', ' ', $category_search_slug1);

    $cat_search_row = getSlugProductCategory($category_search_slug);  //Fetch Category Id using category name

    $category_id = $cat_search_row['category_id'];

    $category_search_name = $cat_search_row['category_name'];

    $category_search_query = "AND FIND_IN_SET($category_id, category_id)";

    $WHERE[] = "FIND_IN_SET($category_id, t1.category_id)";

}

if (isset($_REQUEST['subcategory']) && !empty($_REQUEST['subcategory'])) {
    //Sub category process From GET

    $subcategory_search_slug1 = str_replace('-', ' ', $_GET['subcategory']);

    $subcategory_search_slug = str_replace('.php', '', $subcategory_search_slug1);

    if (strstr($subcategory_search_slug, ',')) {
        $data2 = explode(',', $subcategory_search_slug);
        $sub_cat_array = array();

        foreach ($data2 as $c) {

            if ($c != NULL) {

                $subcat_search_row = getSlugProductSubCategory($c);  //Fetch Sub Category Id using sub category name

                $subcategory_id = $subcat_search_row['sub_category_id'];

                $sub_cat_array[] = "FIND_IN_SET($subcategory_id,sub_category_id)";

                $sub_cat_array1[] = "FIND_IN_SET($subcategory_id,t1.sub_category_id)";

            }
        }
        $sub_category_search_query = 'AND (' . implode(' OR ', $sub_cat_array) . ')';

        $WHERE[] = '(' . implode(' OR ', $sub_cat_array1) . ')';

    } else {

        $subcat_search_row = getSlugProductSubCategory($subcategory_search_slug);  //Fetch Sub Category Id using sub category name

        $subcategory_id = $subcat_search_row['sub_category_id'];

        $sub_category_search_query = 'AND (FIND_IN_SET(' . $subcategory_id . ',sub_category_id))';

        $WHERE[] = '(FIND_IN_SET(' . $subcategory_id . ',t1.sub_category_id))';
    }
}

$price_check = $_REQUEST['price'];

//Price Check starts
if (!empty($price_check)) {

    if (strstr($price_check, ',')) {
        $data8 = explode(',', $price_check);
        $cityarray = array();
        foreach ($data8 as $ci) {
            if ($ci == 'below-100') {
                $start_price = 0;
                $end_price = 100;
            } elseif ($ci == '101-250') {
                $start_price = 101;
                $end_price = 250;
            } elseif ($ci == '251-500') {
                $start_price = 251;
                $end_price = 500;
            } elseif ($ci == '501-1000') {
                $start_price = 501;
                $end_price = 1000;
            } else {
                $start_price = 1001;
                $end_price = 100000;
            }
            $cityarray[] = "t1.product_price BETWEEN $start_price AND $end_price";

        }
        $WHERE[] = '(' . implode(' OR ', $cityarray) . ')';
    } else {

        if ($price_check == 'below-100') {
            $start_price = 0;
            $end_price = 100;
        } elseif ($price_check == '101-250') {
            $start_price = 101;
            $end_price = 250;
        } elseif ($price_check == '251-500') {
            $start_price = 251;
            $end_price = 500;
        } elseif ($price_check == '501-1000') {
            $start_price = 501;
            $end_price = 1000;
        } else {
            $start_price = 1001;
            $end_price = 100000;
        }
        $WHERE[] = '(t1.product_price BETWEEN ' . $start_price . ' AND ' . $end_price . ')';

    }

}

//Price Check Ends

$discount_check = $_REQUEST['discount'];
//Discount Check starts
if (!empty($discount_check)) {

    if (strstr($discount_check, ',')) {
        $data63 = explode(',', $discount_check);
        $discountarray = array();
        foreach ($data63 as $dis) {
            if ($dis == 10) {
                $start_discount = 0;
                $end_discount = 10;
            } elseif ($dis == 25) {
                $start_discount = 11;
                $end_discount = 25;
            } elseif ($dis == 50) {
                $start_discount = 26;
                $end_discount = 50;
            } elseif ($dis == 70) {
                $start_discount = 51;
                $end_discount = 70;
            } else {
                $start_discount = 100;
                $end_discount = 100000;
            }
            $discountarray[] = "t1.product_price_offer BETWEEN $start_discount AND  $end_discount";

        }
        $WHERE[] = '(' . implode(' OR ', $discountarray) . ')';
    } else {

        if ($discount_check == 10) {
            $start_discount = 0;
            $end_discount = 10;
        } elseif ($discount_check == 25) {
            $start_discount = 11;
            $end_discount = 25;
        } elseif ($discount_check == 50) {
            $start_discount = 26;
            $end_discount = 50;
        } elseif ($discount_check == 70) {
            $start_discount = 51;
            $end_discount = 70;
        } else {
            $start_discount = 100;
            $end_discount = 100000;
        }
//        $WHERE[] = '(t1.category_id = ' . $cat_check . ')';
        $WHERE[] = '(t1.product_price_offer BETWEEN ' . $start_discount . ' AND  ' . $end_discount . ')';

    }

}

$w = implode(' AND ', $WHERE);
if (!empty($w)) {
    $w = 'WHERE ' . $w;
    $q = 'AND ';
} else {
    $q = 'WHERE ';
}
?>
<!-- START -->
<section>
    <div class="all-listing all-jobs">
        <!--FILTER ON MOBILE VIEW-->
        <div class="fil-mob fil-mob-act">
            <h4><?php echo $BIZBOOK['ALL-PRODUCTS-PRODUCT-FILTERS']; ?> <i class="material-icons">filter_list</i></h4>
        </div>
        <div class="container">
            <div class="row">

                <div class="col-md-3 fil-mob-view">
                    <div class="all-filt">
                        <span class="fil-mob-clo"><i class="material-icons">close</i></span>
                        <div class="all-list-bre">
                                <div class="sec-all-list-bre">
                                <?php
                                    if (isset($_GET['category']) && !empty($_REQUEST['category'])) {
                                        ?>
                                        <h1><?php echo $category_search_name; ?></h1>
                                        <?php
                                    } else {
                                        ?>
                                        <h1><?php echo $BIZBOOK['ALL_CATEGORIES']; ?></h1>
                                        <?php
                                    }
                                    ?>
                                    <ul>
                                        <li><a href="<?php echo $webpage_full_link; ?>"><?php echo $BIZBOOK['HOME']; ?></a></li>
                                        <li>
                                            <a href="<?php echo $webpage_full_link . 'all-products'; ?>"><?php echo $BIZBOOK['ALL_CATEGORY']; ?></a>
                                        </li>
                                        <?php
                                        if (isset($_GET['category']) && !empty($_REQUEST['category'])) {
                                            ?>
                                            <li>
                                                <a href="<?php echo $ALL_PRODUCTS_URL . urlModifier($category_search_slug); ?>"><?php echo $category_search_name; ?></a>
                                            </li>
                                            <?php
                                        } ?>
                                    </ul>
                        </div>
                    </div>
                        <!--START-->
                        <div class="filt-com lhs-cate">
                            <h4><?php echo $BIZBOOK['ALL-LISTING-CATEGORIES']; ?></h4>
                            <div class="dropdown">
                                <select onChange="ProductSubcategoryFilter(this.value);" class="cat_check chosen-select"
                                        name="cat_check" id="cat_check">
                                    <option value=""><?php echo $BIZBOOK['SELECT_CATEGORY']; ?></option>
                                    <?php
                                    foreach (getAllActiveProductCategoriesPos() as $categories_row) {
                                        ?>
                                        ?>
                                        <option <?php if ($category_search_slug == strtolower($categories_row['category_slug'])) {
                                            echo 'selected';
                                        } ?>
                                                value="<?php echo urlModifier($categories_row['category_slug']); ?>"><?php echo $categories_row['category_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!--END-->

                        <!--START-->
                        <div class="filt-com sub_cat_section pro-fil-sub">
                            <h4><?php echo $BIZBOOK['ALL-LISTING-SUB-CATEGORY']; ?></h4>
                            <ul>
                                <?php
                                if (isset($_GET['category']) && !empty($_REQUEST['category'])) {
                                    $sub_category_qry = getCategoryProductSubCategories($category_id);
                                } else {
                                    $sub_category_qry = getAllProductSubCategories();
                                }
                                foreach ($sub_category_qry as $sub_category_row) {

                                    $hyphend_sub_category_name2 = urlModifier($sub_category_row['sub_category_slug']);

                                    ?>
                                    <li>
                                        <div class="chbox">
                                            <input type="checkbox" class="sub_cat_check" name="sub_cat_check"
                                                   value="<?php echo $hyphend_sub_category_name2; ?>"
                                                <?php
                                                $subcategory_id_new = explode(',', $_GET['subcategory']);
                                                if (in_array($hyphend_sub_category_name2, $subcategory_id_new)) {
                                                    echo "checked";
                                                } ?>
                                                   id="<?php echo $sub_category_row['sub_category_name']; ?>"/>
                                            <label
                                                    for="<?php echo $sub_category_row['sub_category_name']; ?>"><?php echo $sub_category_row['sub_category_name']; ?></label>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <!--END-->

                        <!--START-->
                        <div class="filt-com pro-fil-pri">
                            <h4><?php echo $BIZBOOK['PRICE']; ?></h4>
                            <ul>
                                <li>
                                    <div class="chbox">
                                        <input type="checkbox" name="price_check"
                                               value="10000"
                                            <?php
                                            $price_new = explode(',', $_GET['price']);
                                            if (in_array(10000, $price_new)) {
                                                echo "checked";
                                            } ?>
                                               class="price_check"
                                               id="price_check5"/>
                                        <label
                                                for="price_check5"><?php echo $BIZBOOK['ABOVE']; ?> <?php if ($footer_row['currency_symbol_pos'] == 1) {
                                                echo $footer_row['currency_symbol'];
                                            } ?>1000 <?php if ($footer_row['currency_symbol_pos'] == 2) {
                                                echo $footer_row['currency_symbol'];
                                            } ?></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="chbox">
                                        <input type="checkbox" name="price_check"
                                               value="501-1000"
                                            <?php
                                            $price_new = explode(',', $_GET['price']);
                                            if (in_array('501-1000', $price_new)) {
                                                echo "checked";
                                            } ?>
                                               class="price_check"
                                               id="price_check4"/>
                                        <label
                                                for="price_check4"><?php if ($footer_row['currency_symbol_pos'] == 1) {
                                                echo $footer_row['currency_symbol'];
                                            } ?>501<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                                echo $footer_row['currency_symbol'];
                                            } ?> - <?php if ($footer_row['currency_symbol_pos'] == 1) {
                                                echo $footer_row['currency_symbol'];
                                            } ?>1000<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                                echo $footer_row['currency_symbol'];
                                            } ?></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="chbox">
                                        <input type="checkbox" name="price_check"
                                               value="251-500"
                                            <?php
                                            $price_new = explode(',', $_GET['price']);
                                            if (in_array('251-500', $price_new)) {
                                                echo "checked";
                                            } ?>
                                               class="price_check"
                                               id="price_check3"/>
                                        <label
                                                for="price_check3"><?php if ($footer_row['currency_symbol_pos'] == 1) {
                                                echo $footer_row['currency_symbol'];
                                            } ?>251<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                                echo $footer_row['currency_symbol'];
                                            } ?> - <?php if ($footer_row['currency_symbol_pos'] == 1) {
                                                echo $footer_row['currency_symbol'];
                                            } ?>500<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                                echo $footer_row['currency_symbol'];
                                            } ?></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="chbox">
                                        <input type="checkbox" name="price_check"
                                               value="101-250"
                                            <?php
                                            $price_new = explode(',', $_GET['price']);
                                            if (in_array('101-250', $price_new)) {
                                                echo "checked";
                                            } ?>
                                               class="price_check"
                                               id="price_check2"/>
                                        <label
                                                for="price_check2"><?php if ($footer_row['currency_symbol_pos'] == 1) {
                                                echo $footer_row['currency_symbol'];
                                            } ?>101<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                                echo $footer_row['currency_symbol'];
                                            } ?> - <?php if ($footer_row['currency_symbol_pos'] == 1) {
                                                echo $footer_row['currency_symbol'];
                                            } ?>250<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                                echo $footer_row['currency_symbol'];
                                            } ?></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="chbox">
                                        <input type="checkbox" name="price_check"
                                               value="below-100"
                                            <?php
                                            $price_new = explode(',', $_GET['price']);
                                            if (in_array('below-100', $price_new)) {
                                                echo "checked";
                                            } ?>
                                               class="price_check"
                                               id="price_check1"/>
                                        <label
                                                for="price_check1"><?php echo $BIZBOOK['BELOW']; ?> <?php if ($footer_row['currency_symbol_pos'] == 1) {
                                                echo $footer_row['currency_symbol'];
                                            } ?>100<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                                echo $footer_row['currency_symbol'];
                                            } ?></label>
                                    </div>
                                </li>


                            </ul>
                        </div>
                        <!--END-->

                        <div class="filt-com pro-fil-dis">
                            <h4>Discounts</h4>
                            <ul>
                                <li>
                                    <div class="chbox">
                                        <input type="checkbox" name="discount_check"
                                               value="130"
                                            <?php
                                            $discount_new = explode(',', $_GET['discount']);
                                            if (in_array(130, $discount_new)) {
                                                echo "checked";
                                            } ?>
                                               class="discount_check"
                                               id="discount_check5"/>
                                        <label
                                                for="discount_check5"><?php echo $BIZBOOK['ABOVE']; ?> 70%</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="chbox">
                                        <input type="checkbox" name="discount_check"
                                               value="70"
                                            <?php
                                            $discount_new = explode(',', $_GET['discount']);
                                            if (in_array(70, $discount_new)) {
                                                echo "checked";
                                            } ?>
                                               class="discount_check"
                                               id="discount_check4"/>
                                        <label
                                                for="discount_check4">51% - 70%</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="chbox">
                                        <input type="checkbox" name="discount_check"
                                               value="50"
                                            <?php
                                            $discount_new = explode(',', $_GET['discount']);
                                            if (in_array(50, $discount_new)) {
                                                echo "checked";
                                            } ?>
                                               class="discount_check"
                                               id="discount_check3"/>
                                        <label
                                                for="discount_check3">26% - 50%</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="chbox">
                                        <input type="checkbox" name="discount_check"
                                               value="25"
                                            <?php
                                            $discount_new = explode(',', $_GET['discount']);
                                            if (in_array(25, $discount_new)) {
                                                echo "checked";
                                            } ?>
                                               class="discount_check"
                                               id="discount_check2"/>
                                        <label
                                                for="discount_check2">11% - 25%</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="chbox">
                                        <input type="checkbox" name="discount_check"
                                               value="10"
                                            <?php
                                            $discount_new = explode(',', $_GET['discount']);
                                            if (in_array(10, $discount_new)) {
                                                echo "checked";
                                            } ?>
                                               class="discount_check"
                                               id="discount_check1"/>
                                        <label
                                                for="discount_check1"><?php echo $BIZBOOK['BELOW']; ?> 10%</label>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!--START-->
                        <div class="filt-com lhs-ads">
                            <ul>
                                <li>
                                    <div class="ads-box">
                                        <?php
                                        $ad_position_id = 10;   //Ad position on All Products page left
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
                </div>

                <div class="col-md-9">
                    <?php
                    //                            $productsql = "SELECT *
                    //										FROM " . TBL . "products  WHERE product_status= 'Active'
                    //
                    //										$category_search_query $city_search_query ORDER BY product_id DESC";
                    $productsql = "SELECT DISTINCT  t1 . * FROM  " . TBL . "products  AS t1 $inner $w $q  product_status= 'Active' ORDER BY product_id DESC ";


                    $productrs = mysqli_query($conn, $productsql);
                    $total_products = mysqli_num_rows($productrs);
                    ?>
                    <div class="listng-res">
                        <div class="count_no">Total of
                            <span><?php echo AddingZero_BeforeNumber($total_products); ?></span> product result(s)
                            Found.
                        </div>
                        <div class="list-res-selt">

                        <!-- //Filter Category name   -->
                        <?php
                        if (isset($_GET['category']) && !empty($_GET['category'])) { ?>
                            <span class="product-filters-span"
                                  id="<?php echo strtolower($category_search_slug1); ?>"
                                  data-id="<?php echo (!isset($_GET['category'])) ? 1 : 2; ?>"
                                  data-type="category"><?php echo $category_search_name; ?></span>
                        <?php } ?>

                        <!-- //Filter Sub category name   -->
                        <?php
                        if (isset($_REQUEST['subcategory']) && !empty($_REQUEST['subcategory'])) {

                            $get_subcategory_new = explode(',', $_GET['subcategory']);

                            foreach ($get_subcategory_new as $c) {
                                $get_subcategory1 = str_replace('-', ' ', $c);

                                if ($get_subcategory1 != NULL) {

                                    $job_sub_category_row = getSlugProductSubCategory($get_subcategory1);

                                    $hyphend_sub_category_name = urlModifier($job_sub_category_row['sub_category_slug']);
                                    ?>
                                    <span class="product-filters-span"
                                          id="<?php echo $hyphend_sub_category_name; ?>"
                                          data-type="sub_cat"><?php echo $job_sub_category_row['sub_category_name']; ?></span>
                                <?php }
                            }
                        } ?>

                        <!-- //Filter Price   -->
                        <?php
                        if (isset($_REQUEST['price']) && $_REQUEST['price'] != NULL) {

                            $price_new1 = explode(',', $price_check);

                            if (in_array(10000, $price_new1)) { ?>
                                <span class="product-filters-span" id="10000"
                                      data-type="price"><?php
                                    echo $BIZBOOK['ABOVE'];
                                    if ($footer_row['currency_symbol_pos'] == 1) {
                                        echo $footer_row['currency_symbol'];
                                    } ?>1000 <?php if ($footer_row['currency_symbol_pos'] == 2) {
                                        echo $footer_row['currency_symbol'];
                                    }
                                    ?></span>
                            <?php }
                            $price_new1 = explode(',', $price_check);
                            if (in_array('501-1000', $price_new1)) { ?>
                                <span class="product-filters-span" id="501-1000"
                                      data-type="price"><?php
                                    if ($footer_row['currency_symbol_pos'] == 1) {
                                        echo $footer_row['currency_symbol'];
                                    } ?>501<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                        echo $footer_row['currency_symbol'];
                                    } ?> - <?php if ($footer_row['currency_symbol_pos'] == 1) {
                                        echo $footer_row['currency_symbol'];
                                    } ?>1000<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                        echo $footer_row['currency_symbol'];
                                    }
                                    ?></span>
                            <?php }
                            $price_new1 = explode(',', $price_check);
                            if (in_array('251-500', $price_new1)) { ?>
                                <span class="product-filters-span" id="251-500"
                                      data-type="price"><?php
                                    if ($footer_row['currency_symbol_pos'] == 1) {
                                        echo $footer_row['currency_symbol'];
                                    } ?>251<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                        echo $footer_row['currency_symbol'];
                                    } ?> - <?php if ($footer_row['currency_symbol_pos'] == 1) {
                                        echo $footer_row['currency_symbol'];
                                    } ?>500<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                        echo $footer_row['currency_symbol'];
                                    }
                                    ?></span>

                            <?php }
                            $price_new1 = explode(',', $price_check);
                            if (in_array('101-250', $price_new1)) { ?>

                                <span class="product-filters-span" id="101-250"
                                      data-type="price"><?php
                                    if ($footer_row['currency_symbol_pos'] == 1) {
                                        echo $footer_row['currency_symbol'];
                                    } ?>101<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                        echo $footer_row['currency_symbol'];
                                    } ?> - <?php if ($footer_row['currency_symbol_pos'] == 1) {
                                        echo $footer_row['currency_symbol'];
                                    } ?>250<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                        echo $footer_row['currency_symbol'];
                                    }
                                    ?></span>
                            <?php }
                            $price_new1 = explode(',', $price_check);
                            if (in_array('below-100', $price_new1)) { ?>

                                <span class="product-filters-span" id="below-100"
                                data-type="price"><?php
                                echo $BIZBOOK['BELOW']; ?> <?php if ($footer_row['currency_symbol_pos'] == 1) {
                                    echo $footer_row['currency_symbol'];
                                } ?>100<?php if ($footer_row['currency_symbol_pos'] == 2) {
                                    echo $footer_row['currency_symbol'];
                                }
                            } ?></span>
                        <?php } ?>

                        <!-- //Filter Discount   -->
                        <?php
                        if (isset($_REQUEST['discount']) && $_REQUEST['discount'] != NULL && $_REQUEST['discount'] != 0) {

                            $discount_new1 = explode(',', $discount_check);

                            if (in_array(130, $discount_new1)) { ?>
                                <span class="product-filters-span" id="130"
                                      data-type="discount"><?php echo $BIZBOOK['ABOVE']; ?> 70%</span>
                            <?php }

                            $discount_new1 = explode(',', $discount_check);
                            if (in_array(70, $discount_new1)) { ?>
                                <span class="product-filters-span" id="70"
                                      data-type="discount">51% - 70%</span>
                            <?php }

                            $discount_new1 = explode(',', $discount_check);
                            if (in_array(50, $discount_new1)) { ?>
                                <span class="product-filters-span" id="50"
                                      data-type="discount">26% - 50%</span>
                            <?php }

                            $discount_new1 = explode(',', $discount_check);
                            if (in_array(25, $discount_new1)) { ?>
                                <span class="product-filters-span" id="25"
                                      data-type="discount">11% - 25%</span>
                            <?php }

                            $discount_new1 = explode(',', $discount_check);
                            if (in_array(10, $discount_new1)) { ?>
                                <span class="product-filters-span" id="10"
                                data-type="discount"><?php echo $BIZBOOK['BELOW']; ?> 10%</span>
                        <?php }
                        } ?>

                    </div>
                    </div>
                    
                    <!--RESULTS SELECTED FILTER-->
                    <div class="all-list-sh all-product-total">
                        <ul class="products-wrapper">
                            <?php
                            if (mysqli_num_rows($productrs) > 0) {

                                while ($productrow = mysqli_fetch_array($productrs)) {

                                    $product_id = $productrow['product_id'];
                                    $list_user_id = $productrow['user_id'];

                                    $usersqlrow = getUser($list_user_id); // To Fetch particular User Data
                                    ?>

                                    <li class="products-item">
                                        <div class="all-pro-box">
                                            <div class="all-pro-img">
                                                <img loading="lazy"
                                                     src="<?php echo $slash; ?><?php if ($productrow['gallery_image'] != NULL || !empty($productrow['gallery_image'])) {
                                                         echo "images/products/" . array_shift(explode(',', $productrow['gallery_image']));
                                                     } else {
                                                         echo "images/listings/" . $footer_row['listing_default_image'];
                                                     } ?>">
                                            </div>
                                            <div class="all-pro-txt">
                                                <h4><?php echo $productrow['product_name']; ?></h4>
                                                <span class="pri"><b
                                                            class="pro-off"><?php if ($footer_row['currency_symbol_pos'] == 1) {
                                                            echo $footer_row['currency_symbol'];
                                                        } ?><?php echo $productrow['product_price']; ?><?php if ($footer_row['currency_symbol_pos'] == 2) {
                                                            echo $footer_row['currency_symbol'];
                                                        } ?></b>
                                                    <?php if ($productrow['product_price_offer'] != NULL) { ?>
                                                        <?php echo $productrow['product_price_offer']; ?>% off<?php } ?>
                                                </span>
                                            </div>
                                            <div class="pg-pro-buy-cta">
                                                <a href="cart" class="cta-buy-now">Buy now</a>
                                                <!--<span class="cta-add-cart">Add to cart</span>-->
                                            </div>
                                            <a href="<?php echo $PRODUCT_URL . urlModifier($productrow['product_slug']); ?>"
                                               class="pro-view-full"></a>
                                        </div>
                                    </li>


                                    <?php
                                }
                            } else {
                                ?>
                                <span style="    font-size: 21px;
    color: #bfbfbf;
    letter-spacing: 1px;
    /* background: #525252; */
    text-shadow: 0px 0px 2px #fff;
    text-transform: uppercase;
    margin-top: 5%;"><?php echo $BIZBOOK['PRODUCTS_NO_PRODUCTS_MESSAGE']; ?></span>
                                <?php
                            }
                            ?>

                        </ul>
                        <!--                        <div id="product-pagination-container"></div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

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
<script type="text/javascript">var webpage_full_link = '<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url = '<?php echo $LOGIN_URL;?>';</script>
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>js/product_filter.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash; ?>js/custom_validation.js"></script>
<script src="<?php echo $slash; ?>js/jquery.simplePagination.min.js"></script>
<script>

    var items = $(".products-wrapper .products-item");
    var numItems = items.length;
    var perPage = 20;

    items.slice(perPage).hide();

    $('#product-pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
            $("html, body").animate({scrollTop: 0}, "fast");
            return false;
        }
    });
</script>
<script>
    <?php foreach (getAllProduct() as $rowq){ ?>
    $('.qvv<?php echo $rowq['product_code'] ?>').on('click', function () {
        $('.list-qview<?php echo $rowq['product_code'] ?>').addClass('qview-show');
    });
    $('.list-qview<?php echo $rowq['product_code'] ?>').on('mouseleave', function () {
        $('.list-qview<?php echo $rowq['product_code'] ?>').removeClass('qview-show');
    });
    <?php
    }
    ?>
</script>
<script>
    function ProductSubcategoryFilter(val) {
//        alert(val);
//        $(".sub_cat_section").remove();
        Productbreadcrumbs(val);                        //Function call to change breadcrumb
        $(".sub_cat_section").css("opacity", 0);
        $.ajax({
            type: "POST",
            url: "<?php echo $slash; ?>product_sub_category_filter.php",
            data: 'category_id=' + val,
            success: function (data) {
                if (data == null) {
                    $(".sub_cat_section").remove();
                } else {
                    $(".sub_cat_section").html(data);
                    $(".sub_cat_section").css("opacity", 1);
                }

            }
        });
    }
</script>

<script>
    function Productbreadcrumbs(val) {
        $(".sec-all-list-bre").css("opacity", 0);
        $.ajax({
            type: "POST",
            url: "<?php echo $slash; ?>product_category_filter_breadcrumb.php",
            data: 'category_id=' + val,
            success: function (data) {
                if (data == null) {
                    $(".sec-all-list-bre").css("opacity", 1);
                } else {
                    $(".sec-all-list-bre").html(data);
                    $(".sec-all-list-bre").css("opacity", 1);
                }

            }
        });
    }
</script>
</body>

</html>