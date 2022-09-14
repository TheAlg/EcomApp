<!-- Cart-->
{% if controllerName is 'cart' %}

<aside class="col-lg-3">
    <div class="summary summary-cart">
        <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

        <table class="table table-summary">
            <tbody>
                <tr class="summary-subtotal">
                    <td>Subtotal:</td>
                    <td id="cart-view-subPrice">$ {{cart.subTotal}}</td>
                </tr><!-- End .summary-subtotal -->
                <tr class="summary-shipping">
                    <td>Shipping:</td>
                    <td>&nbsp;</td>
                </tr>

                <tr class="summary-shipping-row">
                    <td>
                        <div class="custom-control custom-radio">
                            {{ v.radioCheck(cart.shippingOptions['free'],  cart.shippingFees, 'free-shipping') }}
                            <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                        </div><!-- End .custom-control -->
                    </td>
                    <td>${{cart.shippingOptions['free']}}</td>
                </tr><!-- End .summary-shipping-row -->

                <tr class="summary-shipping-row">
                    <td>
                        <div class="custom-control custom-radio">
                            {{ v.radioCheck(cart.shippingOptions['standart'],  cart.shippingFees, 'standart-shipping') }}
                            <label class="custom-control-label" for="standart-shipping">Standart:</label>
                        </div><!-- End .custom-control -->
                    </td>
                    <td>${{cart.shippingOptions['standart']}}</td>
                </tr><!-- End .summary-shipping-row -->

                <tr class="summary-shipping-row">
                    <td>
                        <div class="custom-control custom-radio">
                            {{ v.radioCheck(cart.shippingOptions['express'],  cart.shippingFees, 'express-shipping') }}
                            <label class="custom-control-label" for="express-shipping">Express:</label>
                        </div><!-- End .custom-control -->
                    </td>
                    <td>${{cart.shippingOptions['express']}}</td>
                </tr><!-- End .summary-shipping-row -->

                <tr class="summary-shipping-estimate">
                    <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>
                    <td>&nbsp;</td>
                </tr><!-- End .summary-shipping-estimate -->

                <tr class="summary-total">
                    <td>Total:</td>
                    <td id ="cart-view-price">${{ cart.total }} </td>
                </tr><!-- End .summary-total -->
            </tbody>
        </table><!-- End .table table-summary -->

        <a href="/checkout" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
    </div><!-- End .summary -->

    {% if controllerName is 'cart' %}
        <a href="/products" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
    {% endif %}
</aside><!-- End .col-lg-3 -->

{% else %}
<!-- Checkout -->
<aside class="col-lg-4" id="stickySide">
        <div class="summary">
            <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

            <table class="table table-summary">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    {% for product in cart.content %}           

                    <tr>
                        <td><a href="#"> {{product.qty}} x {{product.title}}</a></td>
                        <td>${{product.price}}</td>
                    </tr>

                    {% endfor %}
                    <tr class="summary-subtotal">
                        <td>Subtotal:</td>
                        <td>${{cart.subTotal}}</td>
                    </tr><!-- End .summary-subtotal -->
                    <tr>
                        <td>Shipping:</td>
                        <td>{{ cart.shippingOption | capitalize}}</td>
                    </tr>
                    <tr class="summary-total">
                        <td>Total:</td>
                        <td>${{cart.total}}</td>
                    </tr><!-- End .summary-total -->
                </tbody>
            </table><!-- End .table table-summary -->

         
        </div><!-- End .summary -->
</aside><!-- End .col-lg-3 -->

{% endif %}