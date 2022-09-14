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
                {% include 'templates/main_banners.volt' %}
                </div><!-- End .owl-carousel owl-simple -->
            <span class="slider-loader"></span><!-- End .slider-loader -->
            </div><!-- End .intro-slider-container -->
            {% for category in v.push('Hot Deals Products', categories.categories) if category is not "Life Style" %}
                {{ v.div(category) }}
                    <div class="container {{category}}">
                        <div class="heading heading-flex heading-border mb-3">
                            <div class="heading-left">
                                <h2 class="title">{{category}}</h2>
                            </div>

                            <!-- links -->
                            <div class="heading-right">
                                <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                                    {% for tab in v.subCategories(category, v.push('All', categories.categories)) if tab is not "Life Style" %}           
                                        <li class="nav-item">
                                            <a class="{{ v.class(tab) }}" id="{{v.link(category,tab)}}" data-toggle="tab" href="#{{v.tab(category, tab)}}" 
                                            role="tab" aria-controls="{{v.tab(category, tab)}}" aria-selected="{{v.selected(tab)}}">{{ tab }}</a>
                                        </li>
                                    {% endfor %}
                                </ul>
                            </div><!-- End .heading-right -->
                        </div><!-- End .heading -->

                        <!-- contents -->
                        <div class="tab-content tab-content-carousel">
                            {% for tab in v.subCategories(category, v.push('All', categories.categories)) %}
                                <div class="{{ v.showActive(tab) }}" id="{{v.tab(category, tab)}}" role="tabpanel" aria-labelledby="{{v.link(category, tab)}}">
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
                                            {% for product in allProducts %}
                                                {% 
                                                    if product.category is category and tab is "All" 
                                                    or product.category is category and tab is "New" and product.new is 'Y' 
                                                    or product.category is category and tab is "Best Seller" and product.sale is "Y" 
                                                    or category is 'Hot Deals Products' and tab is 'All'
                                                    or category is 'Hot Deals Products' and product.category is tab  
                                                %}
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            {% if product.sale== "Y" %}<span class="product-label label-sale">Sale</span>{% endif %}
                                                            {% if product.top == "Y" %}<span class="product-label label-top">Top</span>{% endif %}                                        
                                                            {% if product.new == "Y" %}<span class="product-label label-new">New</span>{% endif %}                                        
                                                            <a href="product.html"><img src="{{product.picture}}" alt="Product image" class="product-image"></a>
                                                            {% if v.date(product.expiry_date) < 200 %}
                                                                <div class="product-countdown" data-until="+{{v.date(product.expiry_date)}}d" data-format="DHM" data-relative="true" data-labels-short="true"></div><!-- End .product-countdown -->
                                                            {% endif %}
                                                            <div class="product-action-vertical">
                                                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                                                <a href="" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                                                <a href="/item/{{product.id}}" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                                            </div><!-- End .product-action-vertical -->

                                                            <div class="product-action" type="submit">
                                                                <a type="submit" class="btn-product btn-cart" id= "{{product.id}}" title="Add to cart"><span>add to cart</span></a>
                                                            </div><!-- End .product-action -->
                                                        </figure><!-- End .product-media -->

                                                        <div class="product-body">
                                                            <div class="product-cat">
                                                                <a href="#">{{product.category}}</a>
                                                            </div><!-- End .product-cat -->
                                                            <h3 class="product-title"><a href="product.html">{{product.title}}</a></h3><!-- End .product-title -->
                                                            <div class="product-price">
                                                                <span class="new-price">${{product.price}}</span>
                                                                {% if v.oldPrice(product.id) != null %}
                                                                    <span class="old-price">Was ${{v.oldPrice(product.id)}}</span>
                                                                {% endif %}
                                                            </div><!-- End .product-price -->
                                                            <div class="ratings-container">
                                                                <div class="ratings">
                                                                    <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                                                </div><!-- End .ratings -->
                                                                <span class="ratings-text">( 2 Reviews )</span>
                                                            </div><!-- End .rating-container -->
                                                            <div class="product-nav product-nav-dots">
                                                                {% for color in product.colors %}
                                                                <a href="#"  style="background:{{color}};"><span class="sr-only">Color name</span></a>
                                                                {% endfor %}
                                                            </div><!-- End .product-nav -->
                                                        </div><!-- End .product-body -->
                                                    </div><!-- All products -->
                                                {% endif%}
                                            {% endfor %}
                                            </div><!-- End .owl-carousel -->
                                    </div><!-- .End .tab-pane -->
                            {% endfor %}
                        </div><!-- End .tab-content -->
                    </div><!-- End .container -->
                {{ v.closediv() }}
                <div class="mb-3"></div><!-- End .mb-3 -->
            {% endfor %}      
        </main><!-- End .main -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
</body>
