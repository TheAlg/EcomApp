<!-- Cart-->
<?php if ($controllerName == 'cart') { ?>

<aside class="col-lg-3">
    <div class="summary summary-cart">
        <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

        <table class="table table-summary">
            <tbody>
                <tr class="summary-subtotal">
                    <td>Subtotal:</td>
                    <td id="cart-view-subPrice">$ <?= $this->cart->subTotal ?></td>
                </tr><!-- End .summary-subtotal -->
                <tr class="summary-shipping">
                    <td>Shipping:</td>
                    <td>&nbsp;</td>
                </tr>

                <tr class="summary-shipping-row">
                    <td>
                        <div class="custom-control custom-radio">
                            <?= $this->v->radioCheck($this->cart->shippingOptions['free'], $this->cart->shippingFees, 'free-shipping') ?>
                            <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                        </div><!-- End .custom-control -->
                    </td>
                    <td>$<?= $this->cart->shippingOptions['free'] ?></td>
                </tr><!-- End .summary-shipping-row -->

                <tr class="summary-shipping-row">
                    <td>
                        <div class="custom-control custom-radio">
                            <?= $this->v->radioCheck($this->cart->shippingOptions['standart'], $this->cart->shippingFees, 'standart-shipping') ?>
                            <label class="custom-control-label" for="standart-shipping">Standart:</label>
                        </div><!-- End .custom-control -->
                    </td>
                    <td>$<?= $this->cart->shippingOptions['standart'] ?></td>
                </tr><!-- End .summary-shipping-row -->

                <tr class="summary-shipping-row">
                    <td>
                        <div class="custom-control custom-radio">
                            <?= $this->v->radioCheck($this->cart->shippingOptions['express'], $this->cart->shippingFees, 'express-shipping') ?>
                            <label class="custom-control-label" for="express-shipping">Express:</label>
                        </div><!-- End .custom-control -->
                    </td>
                    <td>$<?= $this->cart->shippingOptions['express'] ?></td>
                </tr><!-- End .summary-shipping-row -->

                <tr class="summary-shipping-estimate">
                    <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>
                    <td>&nbsp;</td>
                </tr><!-- End .summary-shipping-estimate -->

                <tr class="summary-total">
                    <td>Total:</td>
                    <td id ="cart-view-price">$<?= $this->cart->total ?> </td>
                </tr><!-- End .summary-total -->
            </tbody>
        </table><!-- End .table table-summary -->

        <a href="/checkout" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
    </div><!-- End .summary -->

    <?php if ($controllerName == 'cart') { ?>
        <a href="/products" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
    <?php } ?>
</aside><!-- End .col-lg-3 -->

<?php } else { ?>
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
                    <?php foreach ($this->cart->content as $product) { ?>           

                    <tr>
                        <td><a href="#"> <?= $product->qty ?> x <?= $product->title ?></a></td>
                        <td>$<?= $product->price ?></td>
                    </tr>

                    <?php } ?>
                    <tr class="summary-subtotal">
                        <td>Subtotal:</td>
                        <td>$<?= $this->cart->subTotal ?></td>
                    </tr><!-- End .summary-subtotal -->
                    <tr>
                        <td>Shipping:</td>
                        <td><?= ucwords($this->cart->shippingOption) ?></td>
                    </tr>
                    <tr class="summary-total">
                        <td>Total:</td>
                        <td>$<?= $this->cart->total ?></td>
                    </tr><!-- End .summary-total -->
                </tbody>
            </table><!-- End .table table-summary -->

         
        </div><!-- End .summary -->
</aside><!-- End .col-lg-3 -->

<?php } ?>