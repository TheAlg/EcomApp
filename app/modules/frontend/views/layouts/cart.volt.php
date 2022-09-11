<main class="main">
	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
		<div class="container">
			<h1 class="page-title">Shopping Cart<span>Shop</span></h1>
		</div><!-- End .container -->
	</div><!-- End .page-header -->
	<nav aria-label="breadcrumb" class="breadcrumb-nav">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Home</a></li>
				<li class="breadcrumb-item"><a href="#">Shop</a></li>
				<li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
			</ol>
		</div><!-- End .container -->
	</nav><!-- End .breadcrumb-nav -->

	<div class="page-content">
		<div class="cart">
			<div class="container" id = 'cart-page-container'>
					<?php if ($this->length($this->cart->content) > 0) { ?>
					<div class="row">
						<div class="col-lg-9">
						<table class="table table-cart table-mobile">
							<thead>
								<tr>
									<th>Product</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($this->cart->content as $item) { ?>
								<tr>
									<td class="product-col" value="<?= $item->id ?>">
										<div class="product">
											<figure class="product-media">
												<a href="#">
													<img src="<?= $item->picture ?>" alt="Product image">
												</a>
											</figure>

											<h3 class="product-title">
												<a href="#"><?= $item->title ?></a>
											</h3><!-- End .product-title -->
										</div><!-- End .product -->
									</td>
									<td class="price-col">$<?= $item->price ?></td>
									<td class="quantity-col">
										<input type="number" class="form-control qtyInput" value="<?= $item->qty ?>" min="1" max="100" step="1" data-decimals="0" required>
									</td>
									<td class="total-col">$<?= $item->total ?></td>
									<td class="remove-col"><button class="btn-remove"><i class="btn-cart-remove icon-close" value="<?= $item->id ?>" ></i></button></td>
								</tr>
								<?php } ?>

							</tbody>
						</table><!-- End .table table-wishlist -->

						<div class="cart-bottom">
							<div class="cart-discount">
								<form action="#">
									<div class="input-group">
										<input type="text" class="form-control" required placeholder="coupon code">
										<div class="input-group-append">
											<button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
										</div><!-- .End .input-group-append -->
									</div><!-- End .input-group -->
								</form>
							</div><!-- End .cart-discount -->

							<a href="/item/refresh/" id="cart-refresh" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></a>
						</div><!-- End .cart-bottom -->
						</div><!-- End .col-lg-9 -->
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

					</div><!-- End .row -->

						<?php } else { ?>

						<div class="cta bg-image pt-6 pb-7 mb-5" style="background-image: url(assets/images/backgrounds/cta/bg-2.jpg);background-position: center right;">
							<div class="row justify-content-center">
								<div class="col-sm-10 col-md-8 col-lg-6">
									<div class="cta-text text-center">
										<h3 class="cta-title">Checkout our new stuff.</h3><!-- End .cta-title -->
										<p class="cta-desc">Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.</p><!-- End .cta-desc -->
										<a href="/products/" class="btn btn-primary btn-rounded"><span>View shop</span><i class="icon-long-arrow-right"></i></a>
									</div><!-- End .cta-text -->
								</div><!-- End .col-sm-10 col-md-8 col-lg-6 -->
							</div><!-- End .row -->
						</div>
			

						<?php } ?>

			</div><!-- End .container -->
		</div><!-- End .cart -->
	</div><!-- End .page-content -->
</main><!-- End .main -->
			

