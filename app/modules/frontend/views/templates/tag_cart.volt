
<div class="dropdown cart-dropdown">
    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
        <div class="icon">
            <i class="icon-shopping-cart"></i>
            <span class="cart-count" id="cartCount"> {{ cart_count }}</span>
        </div>
        <p>Cart</p>
    </a>      
    <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-cart-products" id="cart_items">  
            {% for item in cart_items %}
                <div class="product productselector" value= " {{ item.productId }} " >
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
                    <a class="btn-remove removeProduct" type= "submit" value ="{{ item.productId }}" title="Remove Product"><i class="icon-close"></i></a>
                </div>
            {% endfor %}
        </div>
        <!--total-->
        <div class="dropdown-cart-total">
            <span>Total</span>
            <span class="cart-total-price" id ="cart-total-price">$ 
                {{ cart_totalPrice }}  
            </span>
        </div>
        <!--actions-->
        <div class="dropdown-cart-action">
            <a href="/cart" class="btn btn-primary">View Cart</a>
            <a href ="" id = "emptyCart" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
        </div>
    </div>    
</div>
