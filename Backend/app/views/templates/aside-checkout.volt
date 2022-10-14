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