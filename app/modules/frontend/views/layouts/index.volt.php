<body>
    <div class="page-wrapper">
        <main class="main">
            <div class="intro-slider-container">
                <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
                        "nav": false,
                        "responsive": {
                            "992": {
                                "nav": true
                            }
                        }
                    }'>
                <?php foreach ($banners as $banner) { ?>
<div class="intro-slide" style="background-image: url(<?= $banner->picturePath ?>);">
    <div class="container intro-content">
        <div class="row">
            <div class="col-auto offset-lg-3 intro-col">
                <h3 class="intro-subtitle"><?= $banner->subtitle ?></h3><!-- End .h3 intro-subtitle -->
                <h1 class="intro-title"><div><?= $this->v->bannerTitle($banner->title) ?></div>
                    <span>
                        <?= $this->v->bannerOldPrice($banner->oldPrice) ?>
                        <span class="text-primary"> $<?= $this->v->BannerNewPrice($banner->newPrice) ?></span>
                    </span>
                </h1><!-- End .intro-title -->

                <a href="category.html" class="btn btn-outline-primary-2">
                    <span>Shop Now</span>
                    <i class="icon-long-arrow-right"></i>
                </a>
            </div><!-- End .col-auto offset-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container intro-content -->
</div>
<?php } ?>
                </div><!-- End .owl-carousel owl-simple -->
            <span class="slider-loader"></span><!-- End .slider-loader -->
            </div><!-- End .intro-slider-container -->
            <?php foreach ($this->v->push('Hot Deals Products', $categories->categories) as $category) { if ($category != 'Life Style') { ?>
                <?= $this->v->div($category) ?>
                    <div class="container <?= $category ?>">
                        <div class="heading heading-flex heading-border mb-3">
                            <div class="heading-left">
                                <h2 class="title"><?= $category ?></h2>
                            </div>

                            <!-- links -->
                            <div class="heading-right">
                                <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                                    <?php foreach ($this->v->subCategories($category, $this->v->push('All', $categories->categories)) as $tab) { if ($tab != 'Life Style') { ?>           
                                        <li class="nav-item">
                                            <a class="<?= $this->v->class($tab) ?>" id="<?= $this->v->link($category, $tab) ?>" data-toggle="tab" href="#<?= $this->v->tab($category, $tab) ?>" 
                                            role="tab" aria-controls="<?= $this->v->tab($category, $tab) ?>" aria-selected="<?= $this->v->selected($tab) ?>"><?= $tab ?></a>
                                        </li>
                                    <?php } ?><?php } ?>
                                </ul>
                            </div><!-- End .heading-right -->
                        </div><!-- End .heading -->

                        <!-- contents -->
                        <div class="tab-content tab-content-carousel">
                            <?php foreach ($this->v->subCategories($category, $this->v->push('All', $categories->categories)) as $tab) { ?>
                                <div class="<?= $this->v->showActive($tab) ?>" id="<?= $this->v->tab($category, $tab) ?>" role="tabpanel" aria-labelledby="<?= $this->v->link($category, $tab) ?>">
                                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                                        data-owl-options='{
                                            "nav": false, 
                                            "dots": true,
                                            "margin": 20,
                                            "loop": false,
                                            "responsive": {
                                                "0": {
                                                    "items":2
                                                },
                                                "480": {
                                                        "items":2
                                                    },
                                                    "768": {
                                                        "items":3
                                                    },
                                                    "992": {
                                                        "items":4
                                                    },
                                                    "1280": {
                                                        "items":5,
                                                        "nav": true
                                                    }
                                                }
                                            }'>
                                            <?php foreach ($allProducts as $product) { ?>
                                                <?php if ($product->category == $category && $tab == 'All' || $product->category == $category && $tab == 'New' && $product->new == 'Y' || $product->category == $category && $tab == 'Best Seller' && $product->sale == 'Y' || $category == 'Hot Deals Products' && $tab == 'All' || $category == 'Hot Deals Products' && $product->category == $tab) { ?>
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            <?php if ($product->sale == 'Y') { ?><span class="product-label label-sale">Sale</span><?php } ?>
                                                            <?php if ($product->top == 'Y') { ?><span class="product-label label-top">Top</span><?php } ?>                                        
                                                            <?php if ($product->new == 'Y') { ?><span class="product-label label-new">New</span><?php } ?>                                        
                                                            <a href="product.html"><img src="<?= $product->picture ?>" alt="Product image" class="product-image"></a>
                                                            <?php if ($this->v->date($product->expiry_date) < 200) { ?>
                                                                <div class="product-countdown" data-until="+<?= $this->v->date($product->expiry_date) ?>d" data-format="DHM" data-relative="true" data-labels-short="true"></div><!-- End .product-countdown -->
                                                            <?php } ?>
                                                            <div class="product-action-vertical">
                                                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                                                <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                                                <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                                            </div><!-- End .product-action-vertical -->

                                                            <div class="product-action">
                                                                <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                                            </div><!-- End .product-action -->
                                                        </figure><!-- End .product-media -->

                                                        <div class="product-body">
                                                            <div class="product-cat">
                                                                <a href="#"><?= $product->category ?></a>
                                                            </div><!-- End .product-cat -->
                                                            <h3 class="product-title"><a href="product.html"><?= $product->title ?></a></h3><!-- End .product-title -->
                                                            <div class="product-price">
                                                                <span class="new-price">$<?= $product->price ?></span>
                                                                <?php if ($this->v->oldPrice($product->id) != null) { ?>
                                                                    <span class="old-price">Was $<?= $this->v->oldPrice($product->id) ?></span>
                                                                <?php } ?>
                                                            </div><!-- End .product-price -->
                                                            <div class="ratings-container">
                                                                <div class="ratings">
                                                                    <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                                                </div><!-- End .ratings -->
                                                                <span class="ratings-text">( 2 Reviews )</span>
                                                            </div><!-- End .rating-container -->
                                                            <div class="product-nav product-nav-dots">
                                                                <?php foreach ($product->colors as $color) { ?>
                                                                <a href="#"  style="background:<?= $color ?>;"><span class="sr-only">Color name</span></a>
                                                                <?php } ?>
                                                            </div><!-- End .product-nav -->
                                                        </div><!-- End .product-body -->
                                                    </div><!-- All products -->
                                                <?php } ?>
                                            <?php } ?>
                                            </div><!-- End .owl-carousel -->
                                    </div><!-- .End .tab-pane -->
                            <?php } ?>
                        </div><!-- End .tab-content -->
                    </div><!-- End .container -->
                <?= $this->v->closediv() ?>
                <div class="mb-3"></div><!-- End .mb-3 -->
            <?php } ?><?php } ?>      
        </main><!-- End .main -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
</body>
