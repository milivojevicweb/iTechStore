<?php
	include "models/cart/functions.php";
	accessAllowCart();
?>
<div class="omotac">
    <div class="cartBuy">
        <div class="cartLeft">
        <input type="hidden" name="hiddenA" id="hiddenA" value="dd"/>
            <script src="https://js.stripe.com/v3/"></script>
            <form action="models/stripe/stripe.php" method="post" id="payment-form">
                <input type="hidden" name="totall" id="sssd" />
            
                <div class="form-row">
                    <label for="card-element">
                        Credit or debit card 
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                    <div id="ssdsdsd"></div>
                </div>

                <button id="buttonCardPay" data-status=1  name="buttonCardPay" ></button>
            </form>
        </div>
        <div class="cartRight darkEmptyLightBackground darkEmptyTextWhite">
          <ul id="productInfo" class="darkEmptyLightBackground darkEmptyTextWhite">

          </ul>
          <hr class="hrPayment">
          <ul class="paymentInfo">
            <li>Subtotal</li>
            <li class="subtotal"></li>
          </ul>
          <hr class="hrPayment">
          <ul class="paymentInfo">
            <li>Shipping</li>
            <li>FREE</li>
          </ul>
          <hr class="hrPayment">
          <ul id="FontStyleTotal" class="paymentInfo">
            <li>Total</li>
            <li class="subtotal">$10000</li>
          </ul>
        </div>
    </div>
</div>
<div id="cartpay">

</div>


<script type="text/javascript" src="assets/js/stripe.js"></script>
<script type="text/javascript" src="assets/js/cart.js"></script>
<script type="text/javascript" src="assets/js/cekiran.js"></script>