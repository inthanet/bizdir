<?php
include "header.php";
?>
<!-- START -->
<div class="comm-ban-head">
    <div class="container">
        <div class="row">
            <h1>Shopping Cart</h1>
        </div>
    </div>
</div>
<div class="pg-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="shopping-cart">
                    <div class="column-labels">
                        <label class="product-image">Image</label>
                        <label class="product-details">Product</label>
                        <label class="product-price">Price</label>
                        <label class="product-quantity">Quantity</label>
                        <label class="product-removal">Remove</label>
                        <label class="product-line-price">Total</label>
                    </div>

                    <div class="product">
                        <div class="product-image">
                            <img
                                src="http://localhost/bizbook/images/products/92311apple-iphone-12-dummyapplefsn-original-imafwg8dpyjvgg3j.jpeg">
                        </div>
                        <div class="product-details">
                            <div class="product-title"><a href="#">Dingo Dog Bones</a></div>
                        </div>
                        <div class="product-price">12.99</div>
                        <div class="product-quantity">
                            <input type="number" value="2" min="1">
                        </div>
                        <div class="product-removal">
                            <button class="remove-product">
                                Remove
                            </button>
                        </div>
                        <div class="product-line-price">25.98</div>
                    </div>

                    <div class="product">
                        <div class="product-image">
                            <img
                                src="http://localhost/bizbook/images/products/92311apple-iphone-12-dummyapplefsn-original-imafwg8dpyjvgg3j.jpeg">
                        </div>
                        <div class="product-details">
                            <div class="product-title"><a href="#">Dingo Dog Bones</a></div>
                        </div>
                        <div class="product-price">45.99</div>
                        <div class="product-quantity">
                            <input type="number" value="1" min="1">
                        </div>
                        <div class="product-removal">
                            <button class="remove-product">
                                Remove
                            </button>
                        </div>
                        <div class="product-line-price">45.99</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cart-totals">
                    <div class="cart-billig">
                    <form name="paytm_dash_form" id="paytm_dash_form" method="post" action="paytm_bypass_submit.php">
                        <input type="hidden" readonly="readonly" class="form-control" name="paytm_dash_user_id" value="323" placeholder="Full name *" required="">

                        <h4>Billing details</h4>
                        <ul>
                            <li>
                                <!--FILED START-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Full name *" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="user_country" class="form-control" placeholder="Country">
                                        </div>
                                    </div>
                                </div>
                                <!--FILED END-->
                                <!--FILED START-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="user_state" class="form-control" placeholder="State">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="user_city" class="form-control" placeholder="City *" required="">
                                        </div>
                                    </div>
                                </div>
                                <!--FILED END-->
                                <!--FILED START-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="user_address" class="form-control" placeholder="Full address">
                                        </div>
                                    </div>
                                </div>
                                <!--FILED END-->
                                <!--FILED START-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="user_zip_code" onkeypress="return isNumber(event)" class="form-control" placeholder="Postcode/ZIP">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="user_contact_name" placeholder="Contact person *" required="">
                                        </div>
                                    </div>
                                </div>
                                <!--FILED END-->
                                <!--FILED START-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="user_contact_mobile" onkeypress="return isNumber(event)" placeholder="Phone number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="user_contact_email"  placeholder="Email Id " required="">
                                        </div>
                                    </div>
                                </div>
                                <!-- FILED END-->
                                <!--FILED START-->
                                
                                <div class="row">
                                    <div class="col-md-12 cart-pay-type">
                                    <h4>Select Payment type</h4>
                                    <div class="form-group">
                                    <select id="payment" class="chosen-select form-control">
                                        <option>PayPal</option>
                                        <option>Stript</option>
                                        <option>RasorPay</option>
                                        <option>PayTm</option>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <!-- FILED END-->
                            </li>
                        </ul>
                    </form>
                    </div>
                <div class="totals">
                        <div class="totals-item">
                            <label>Subtotal</label>
                            <div class="totals-value" id="cart-subtotal">71.97</div>
                        </div>
                        <div class="totals-item">
                            <label>Tax (5%)</label>
                            <div class="totals-value" id="cart-tax">3.60</div>
                        </div>
                        <div class="totals-item">
                            <label>Shipping</label>
                            <div class="totals-value" id="cart-shipping">15.00</div>
                        </div>
                        <div class="totals-item totals-item-total">
                            <label>Grand Total</label>
                            <div class="totals-value" id="cart-total">90.57</div>
                        </div>
                    </div>

                    <button type="submit" name="paytm_dash_form_submit" class="db-pro-bot-btn">
                            Start Payment</button>
                </div>
            </div>
        </div>
    </div>
</div>
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
<script src="js/select-opt.js"></script>
<script type="text/javascript">var webpage_full_link ='<?php echo $webpage_full_link;?>';</script>
<script type="text/javascript">var login_url ='<?php echo $LOGIN_URL;?>';</script>
<script src="js/custom.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>
<script>
    /* Set rates + misc */
var taxRate = 0.05;
var shippingRate = 15.00; 
var fadeTime = 300;


/* Assign actions */
$('.product-quantity input').change( function() {
  updateQuantity(this);
});

$('.product-removal button').click( function() {
  removeItem(this);
});


/* Recalculate cart */
function recalculateCart()
{
  var subtotal = 0;
  
  /* Sum up row totals */
  $('.product').each(function () {
    subtotal += parseFloat($(this).children('.product-line-price').text());
  });
  
  /* Calculate totals */
  var tax = subtotal * taxRate;
  var shipping = (subtotal > 0 ? shippingRate : 0);
  var total = subtotal + tax + shipping;
  
  /* Update totals display */
  $('.totals-value').fadeOut(fadeTime, function() {
    $('#cart-subtotal').html(subtotal.toFixed(2));
    $('#cart-tax').html(tax.toFixed(2));
    $('#cart-shipping').html(shipping.toFixed(2));
    $('#cart-total').html(total.toFixed(2));
    if(total == 0){
      $('.checkout').fadeOut(fadeTime);
    }else{
      $('.checkout').fadeIn(fadeTime);
    }
    $('.totals-value').fadeIn(fadeTime);
  });
}


/* Update quantity */
function updateQuantity(quantityInput)
{
  /* Calculate line price */
  var productRow = $(quantityInput).parent().parent();
  var price = parseFloat(productRow.children('.product-price').text());
  var quantity = $(quantityInput).val();
  var linePrice = price * quantity;
  
  /* Update line price display and recalc cart totals */
  productRow.children('.product-line-price').each(function () {
    $(this).fadeOut(fadeTime, function() {
      $(this).text(linePrice.toFixed(2));
      recalculateCart();
      $(this).fadeIn(fadeTime);
    });
  });  
}


/* Remove item from cart */
function removeItem(removeButton)
{
  /* Remove row from DOM and recalc cart total */
  var productRow = $(removeButton).parent().parent();
  productRow.slideUp(fadeTime, function() {
    productRow.remove();
    recalculateCart();
  });
}
</script>
</body>

</html>