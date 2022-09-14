<div class="dropdown cart-dropdown" id="cart-item">
    <a href="/cart" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" data-display="static">
        <div class="icon">
            <i class="icon-shopping-cart"></i>
            <span class="cart-count" id="cartCount"> {{ cart.count }}</span>
        </div>
        <p>Cart</p>
    </a>      
    <div class="dropdown-menu dropdown-menu-right cart">
        <div class="dropdown-cart-products" id="cart_items">  
            {% for item in cart.content %}
                <div class="product productselector" value= "{{ item.id }}" >
                    <div class="product-cart-details">
                        <h4 class="product-title">
                            <a href="product.html"> {{ item.title }} </a>
                        </h4>
                        <span class="cart-product-info">
                            <span class="cart-product-qty"> {{ item.qty }}
                            </span>
                            x  ${{ item.price }}
                        </span>
                    </div>
                    <figure class="product-image-container">
                        <a href="product.html" class="product-image">
                            <img src="{{ item.picture }}" alt="product">
                        </a>
                    </figure>
                    <a class="btn-remove" type= "submit" title="Remove Product"><i class="icon-close btn-cart-remove" value="{{ item.id }}"></i></a>
                </div>
            {% endfor %}
        </div>
        <!--total-->
        <div class="dropdown-cart-total">
            <span>Total</span>
            <span class="cart-total-price" id ="cart-tag-price">$ 
                {{ cart.total }}  
            </span>
        </div>
        <!--actions-->
        <div class="dropdown-cart-action">
            <a href="/cart/" class="btn btn-primary">View Cart</a>
            <a href ="/checkout/" id = "emptyCart" class="btn btn-outline-primary-2">
                <span>Checkout</span>
                <i class="icon-long-arrow-right"></i>
            </a>
        </div>
    </div>    
</div>
