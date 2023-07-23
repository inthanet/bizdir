<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

include "dashboard_left_pane.php";

if (file_exists('config/general_user_authentication.php')) {
    include('config/general_user_authentication.php');
}

if (file_exists('config/product_page_authentication.php')) {
    include('config/product_page_authentication.php');
}
?>
<!--CENTER SECTION-->
<div class="ud-main">
    <div class="ud-main-inn ud-no-rhs">
        <div class="ud-cen">
            <div class="log-bor">&nbsp;</div>
            <span class="udb-inst"><?php echo $BIZBOOK['ALL_PRODUCTS']; ?></span>
            <?php include('config/user_activation_checker.php'); ?>
            <div class="ud-cen-s2">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab"
                           href="#myproducts"><?php echo $BIZBOOK['PRODUCT_DETAILS']; ?></a>
                    </li>
                    <!--                <li class="nav-item">-->
                    <!--                    <a class="nav-link" data-toggle="tab" href="#mycart">Cart</a>-->
                    <!--                </li>-->
                    <!--                <li class="nav-item">-->
                    <!--                    <a class="nav-link" data-toggle="tab" href="#myorders">My orders</a>-->
                    <!--                </li>-->
                    <!--                <li class="nav-item">-->
                    <!--                    <a class="nav-link" data-toggle="tab" href="#ordersrequ">Order request</a>-->
                    <!--                </li>-->
                    <!--                <li class="nav-item">-->
                    <!--                    <a class="nav-link" data-toggle="tab" href="#paygate">Payment gateway</a>-->
                    <!--                </li>-->
                </ul>
                <div class="tab-content">
                    <div id="myproducts" class="container tab-pane active">
                        <h2><?php echo $BIZBOOK['PRODUCT_DETAILS']; ?></h2>
                        <?php include "page_level_message.php"; ?>
                        <a href="add-new-product" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_PRODUCT']; ?></a>
                        <table class="responsive-table bordered">
                            <thead>
                            <tr>
                                <th><?php echo $BIZBOOK['S_NO']; ?></th>
                                <th><?php echo $BIZBOOK['PRODUCT_NAME']; ?></th>
                                <th><?php echo $BIZBOOK['VIEWS']; ?></th>
                                <th><?php echo $BIZBOOK['STATUS']; ?></th>
                                <th><?php echo $BIZBOOK['EDIT']; ?></th>
                                <th><?php echo $BIZBOOK['DELETE']; ?></th>
                                <th><?php echo $BIZBOOK['PREVIEW']; ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $si = 1;
                            foreach (getAllProductUser($_SESSION['user_id']) as $productrow) {

                                $reviewproduct_id = $productrow['product_id'];

                                ?>
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><img
                                                src="<?php if ($productrow['gallery_image'] != NULL || !empty($productrow['gallery_image'])) {
                                                    echo "images/products/" . array_shift(explode(',', $productrow['gallery_image']));
                                                } else {
                                                    echo "images/listings/" . $footer_row['listing_default_image'];
                                                } ?>"><?php echo $productrow['product_name']; ?>
                                        <span><?php echo dateFormatconverter($productrow['product_cdt']); ?></span></td>
                                    <td>
                                        <span class="db-list-rat"><?php echo product_pageview_count($productrow['product_id']); ?></span>
                                    </td>
                                    <td><span class="db-list-ststus"><?php echo $productrow['product_status']; ?></span>
                                    </td>
                                    <td><a href="edit-product?code=<?php echo $productrow['product_code']; ?>"
                                           class="db-list-edit"><?php echo $BIZBOOK['EDIT']; ?></a></td>
                                    <td><a href="delete-product?code=<?php echo $productrow['product_code']; ?>"
                                           class="db-list-edit"><?php echo $BIZBOOK['DELETE']; ?></a></td>
                                    <td><a href="<?php echo $PRODUCT_URL . urlModifier($productrow['product_slug']); ?>"
                                           class="db-list-edit" target="_blank"><?php echo $BIZBOOK['PREVIEW']; ?></a>
                                    </td>
                                </tr>

                                <?php
                                $si++;
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
<!--                    <div id="mycart" class="container tab-pane">-->
<!--                        <h2>Your cart</h2>-->
<!--                        <div class="shopping-cart">-->
<!--                            <div class="column-labels">-->
<!--                                <label class="product-image">Image</label>-->
<!--                                <label class="product-details">Product</label>-->
<!--                                <label class="product-price">Price</label>-->
<!--                                <label class="product-quantity">Quantity</label>-->
<!--                                <label class="product-removal">Remove</label>-->
<!--                                <label class="product-line-price">Total</label>-->
<!--                            </div>-->
<!--                            <div class="product">-->
<!--                                <div class="product-image">-->
<!--                                    <img src="http://localhost/bizbook/images/products/92311apple-iphone-12-dummyapplefsn-original-imafwg8dpyjvgg3j.jpeg">-->
<!--                                </div>-->
<!--                                <div class="product-details">-->
<!--                                    <div class="product-title"><a href="#">Dingo Dog Bones</a></div>-->
<!--                                </div>-->
<!--                                <div class="product-price">12.99</div>-->
<!--                                <div class="product-quantity">-->
<!--                                    1-->
<!--                                </div>-->
<!--                                <div class="product-removal">-->
<!--                                    <button class="remove-product">-->
<!--                                        Remove-->
<!--                                    </button>-->
<!--                                </div>-->
<!--                                <div class="product-line-price">25.98</div>-->
<!--                            </div>-->
<!---->
<!--                            <div class="product">-->
<!--                                <div class="product-image">-->
<!--                                    <img src="http://localhost/bizbook/images/products/92311apple-iphone-12-dummyapplefsn-original-imafwg8dpyjvgg3j.jpeg">-->
<!--                                </div>-->
<!--                                <div class="product-details">-->
<!--                                    <div class="product-title"><a href="#">Dingo Dog Bones</a></div>-->
<!--                                </div>-->
<!--                                <div class="product-price">45.99</div>-->
<!--                                <div class="product-quantity">-->
<!--                                    1-->
<!--                                </div>-->
<!--                                <div class="product-removal">-->
<!--                                    <button class="remove-product">-->
<!--                                        Remove-->
<!--                                    </button>-->
<!--                                </div>-->
<!--                                <div class="product-line-price">45.99</div>-->
<!--                            </div>-->
<!--                            <a href="cart" class="db-pro-bot-btn cta-caps cta-caps-big">Start Payment</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div id="myorders" class="container tab-pane">-->
<!--                        <h2>Your order status</h2>-->
<!--                        <table class="responsive-table bordered">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>No</th>-->
<!--                                <th>Product Name</th>-->
<!--                                <th>Price</th>-->
<!--                                <th>Status</th>-->
<!--                                <th>Delivered date</th>-->
<!--                                <th>View product</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            <tr>-->
<!--                                <td>1</td>-->
<!--                                <td><img src="images/products/14350coupon-deals.jpg">Iphone 14 Plus <span>Oder date: 03, Aug 2022</span>-->
<!--                                </td>-->
<!--                                <td><span class="db-list-rat">$99</span></td>-->
<!--                                <td><span class="db-list-ststus">Delivered</span></td>-->
<!--                                <td>03, Aug 2022</td>-->
<!--                                <td><a href="http://localhost/bizbook/product/cotton-and-accessories"-->
<!--                                       class="db-list-edit" target="_blank">View</a></td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
<!--                    <div id="ordersrequ" class="container tab-pane">-->
<!--                        <h2>Order request</h2>-->
<!--                        <table class="responsive-table bordered">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>No</th>-->
<!--                                <th>Product Name</th>-->
<!--                                <th>Quantity</th>-->
<!--                                <th>Price</th>-->
<!--                                <th>Payment</th>-->
<!--                                <th>Status</th>-->
<!--                                <th>Via</th>-->
<!--                                <th>Oder details</th>-->
<!--                                <th>Refund</th>-->
<!--                                <th>Update</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            <tr>-->
<!--                                <td>1</td>-->
<!--                                <td><img src="images/products/14350coupon-deals.jpg">Iphone 14 Plus <span>Oder date: 03, Aug 2022</span>-->
<!--                                </td>-->
<!--                                <td>2</td>-->
<!--                                <td><span class="db-list-rat">$99</span></td>-->
<!--                                <td><span class="db-list-rat">Paid</span></td>-->
<!--                                <td><span class="db-list-ststus">New order</span></td>-->
<!--                                <td><span class="db-list-rat">PayPal</span></td>-->
<!--                                <td>-->
<!--                                    <a href="#" class="db-list-edit" data-toggle="modal" data-target="#orddetail">Order-->
<!--                                        details</a>-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <a href="#" class="db-list-edit" data-target="#prostatus">Refund</a>-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <a href="#" class="db-list-edit" data-toggle="modal" data-target="#prostatus">Update-->
<!--                                        status</a>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
<!--                    <div id="paygate" class="container tab-pane">-->
<!--                        <h2>Payment Gateways</h2>-->
<!--                        <table class="responsive-table bordered">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>No</th>-->
<!--                                <th>Payment Gateways</th>-->
<!--                                <th>Key or value</th>-->
<!--                                <th>Status</th>-->
<!--                                <th>Paymeny Key</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            <tr>-->
<!--                                <td>1</td>-->
<!--                                <td>PayPal</td>-->
<!--                                <td><span class="db-list-ststus">rn53themes@gmail.com</span></td>-->
<!--                                <td><span class="db-list-rat">Active</span></td>-->
<!--                                <td><a href="#" class="db-list-edit" data-toggle="modal" data-target="#paygateway">Update</a>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <td>2</td>-->
<!--                                <td>Stripe</td>-->
<!--                                <td><span class="db-list-ststus">YTUIYK9879JHGJ</span></td>-->
<!--                                <td><span class="db-list-rat">In-active</span></td>-->
<!--                                <td><a href="#" class="db-list-edit" data-toggle="modal" data-target="#paygateway">Update</a>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <td>1</td>-->
<!--                                <td>RazorPay</td>-->
<!--                                <td><span class="db-list-ststus">rn53themes@gmail.com</span></td>-->
<!--                                <td><span class="db-list-rat">Active</span></td>-->
<!--                                <td><a href="#" class="db-list-edit" data-toggle="modal" data-target="#paygateway">Update</a>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <td>1</td>-->
<!--                                <td>PayTm</td>-->
<!--                                <td><span class="db-list-ststus">rn53themes@gmail.com</span></td>-->
<!--                                <td><span class="db-list-rat">Active</span></td>-->
<!--                                <td><a href="#" class="db-list-edit" data-toggle="modal" data-target="#paygateway">Update</a>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
                </div>

            </div>
        </div>
        <!--RIGHT SECTION-->
        <?php
        include "dashboard_right_pane.php";
        ?>

        <!-- The Modal -->
<!--        <div class="pop-ups pop-quo job-form">-->
<!--            <div class="modal" id="prostatus">-->
<!--                <div class="modal-dialog">-->
<!--                    <div class="modal-content">-->
<!--                        <div class="log-bor">&nbsp;</div>-->
<!--                        <span class="udb-inst">Update delivery status</span>-->
<!--                        <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--                        <div class="quote-pop">-->
<!--                            <form method="post">-->
<!--                                <div class="form-group">-->
<!--                                    <label class="tit">Expected delivery time</label>-->
<!--                                    <select class="chosen-select" name="" id="">-->
<!--                                        <option value="">Today</option>-->
<!--                                        <option value="">1 Days to go</option>-->
<!--                                        <option value="">2 Days to go</option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label class="tit">Status</label>-->
<!--                                    <select class="chosen-select" name="" id="">-->
<!--                                        <option value="">New order</option>-->
<!--                                        <option value="">Delivered</option>-->
<!--                                        <option value="">Delayed</option>-->
<!--                                        <option value="">Refund</option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                                <button type="submit" id="expert_manage_lead_submit--><?php //echo $enquiry_id; ?><!--"-->
<!--                                        name="expert_manage_lead_submit"-->
<!--                                        class="btn btn-primary">--><?php //echo $BIZBOOK['SUBMIT']; ?><!--</button>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="modal" id="paygateway">-->
<!--                <div class="modal-dialog">-->
<!--                    <div class="modal-content">-->
<!--                        <div class="log-bor">&nbsp;</div>-->
<!--                        <span class="udb-inst">Payment Gateway Keys</span>-->
<!--                        <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--                        <div class="quote-pop">-->
<!--                            <form method="post">-->
<!--                                <div class="form-group">-->
<!--                                    <label class="tit">PayPal:</label>-->
<!--                                    <input type="text">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label class="tit">Stripe:</label>-->
<!--                                    <input type="text">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label class="tit">Razorpay:</label>-->
<!--                                    <input type="text">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label class="tit">PayTm:</label>-->
<!--                                    <input type="text">-->
<!--                                </div>-->
<!--                                <button type="submit" id="expert_manage_lead_submit--><?php //echo $enquiry_id; ?><!--"-->
<!--                                        name="expert_manage_lead_submit"-->
<!--                                        class="btn btn-primary">--><?php //echo $BIZBOOK['SUBMIT']; ?><!--</button>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!---->
<!--            <div class="modal" id="orddetail">-->
<!--                <div class="modal-dialog">-->
<!--                    <div class="modal-content">-->
<!--                        <div class="log-bor">&nbsp;</div>-->
<!--                        <span class="udb-inst">Update delivery status</span>-->
<!--                        <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--                        <div class="quote-pop">-->
<!--                            <table class="responsive-table bordered table">-->
<!--                                <tbody>-->
<!--                                <tr>-->
<!--                                    <td>Name</td>-->
<!--                                    <td>John smith</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>Country</td>-->
<!--                                    <td>USA</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>State</td>-->
<!--                                    <td>Illunois</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>City</td>-->
<!--                                    <td>Illunois</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>Full address</td>-->
<!--                                    <td>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>Postal code</td>-->
<!--                                    <td>465132</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>Contact persion</td>-->
<!--                                    <td>John smith</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>Phone</td>-->
<!--                                    <td>987654621</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>Email id</td>-->
<!--                                    <td>rn53themes@gmail.com</td>-->
<!--                                </tr>-->
<!--                                </tbody>-->
<!--                            </table>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <script>
            /* Set rates + misc */
//            var taxRate = 0.05;
//            var shippingRate = 15.00;
//            var fadeTime = 300;
//
//
//            /* Assign actions */
//            $('.product-quantity input').change(function () {
//                updateQuantity(this);
//            });
//
//            $('.product-removal button').click(function () {
//                removeItem(this);
//            });
//
//
//            /* Recalculate cart */
//            function recalculateCart() {
//                var subtotal = 0;
//
//                /* Sum up row totals */
//                $('.product').each(function () {
//                    subtotal += parseFloat($(this).children('.product-line-price').text());
//                });
//
//                /* Calculate totals */
//                var tax = subtotal * taxRate;
//                var shipping = (subtotal > 0 ? shippingRate : 0);
//                var total = subtotal + tax + shipping;
//
//                /* Update totals display */
//                $('.totals-value').fadeOut(fadeTime, function () {
//                    $('#cart-subtotal').html(subtotal.toFixed(2));
//                    $('#cart-tax').html(tax.toFixed(2));
//                    $('#cart-shipping').html(shipping.toFixed(2));
//                    $('#cart-total').html(total.toFixed(2));
//                    if (total == 0) {
//                        $('.checkout').fadeOut(fadeTime);
//                    } else {
//                        $('.checkout').fadeIn(fadeTime);
//                    }
//                    $('.totals-value').fadeIn(fadeTime);
//                });
//            }
//
//
//            /* Update quantity */
//            function updateQuantity(quantityInput) {
//                /* Calculate line price */
//                var productRow = $(quantityInput).parent().parent();
//                var price = parseFloat(productRow.children('.product-price').text());
//                var quantity = $(quantityInput).val();
//                var linePrice = price * quantity;
//
//                /* Update line price display and recalc cart totals */
//                productRow.children('.product-line-price').each(function () {
//                    $(this).fadeOut(fadeTime, function () {
//                        $(this).text(linePrice.toFixed(2));
//                        recalculateCart();
//                        $(this).fadeIn(fadeTime);
//                    });
//                });
//            }
//
//
//            /* Remove item from cart */
//            function removeItem(removeButton) {
//                /* Remove row from DOM and recalc cart total */
//                var productRow = $(removeButton).parent().parent();
//                productRow.slideUp(fadeTime, function () {
//                    productRow.remove();
//                    recalculateCart();
//                });
            }
        </script>