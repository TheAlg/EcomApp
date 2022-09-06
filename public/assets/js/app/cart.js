const qtyInput = 'qtyInput';
const tagCount = 'cartCount';
const tagPrice = 'cart-tag-price';
const viewPrice = 'cart-view-price';
const viewSubPrice = 'cart-view-subPrice';
const refresh = 'cart-refresh';
const viewContainer = 'cart-page-container';
const cartItems = 'cart_items';

api.cart={
    postItem: async (route, params =null)=>{
        const result = await $.ajax({
            type: "POST", 
            url: route, 
            data: params,             
            error: function() {
                alert("problem communicating with server");
            } 
        });
        const data = await JSON.parse(result);
        return data;
    }
}    
html.cart={
    showTagItem(item)	{	
        var htmlContent =
            "<div class='product productselector' value='"+ item.id+"'>\
                <div class='product-cart-details'>\
                    \<h4 class='product-title'>\
                        <a href='product.html'>"+item.title+ "</a>\
                    \</h4>\
                    \<span class='cart-product-info'>\
                        \<span class='cart-product-qty'>"+item.qty 
                        +"</span> x  $"+ item.price
                    +"</span>\
                \</div>\
                \<figure class='product-image-container'>\
                    \<a href='product.html' class='product-image'>\
                        \<img src='"+item.picture+"'alt='product'>\
                    \</a>\
                \</figure>\
                \<a class='btn-remove' type= 'submit' title='Remove Product'><i class='icon-close btn-cart-remove' value='"+item.id+"'></i></a>\
            \</div>"
            $('#cart_items').prepend(htmlContent);
    },
    checkEmpty(cart){
        if (cart.content.length <= 0)
        $('#cart-page-container').text('');
        $('#cart-page-container').append(`
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
        `)
    },
    // total price and count in shopping cart nav bar
    updateTagTotal(price,count){
        $('#' +tagPrice).text('$ ' + price);
        $('#' +tagCount).text(count);
    },
    // total price and count in shopping cart page
    updateView(item){
        $("#"+viewPrice).text('$'+item.total);
        $("#"+viewSubPrice).text('$'+item.subTotal);
    },
    // update item in shopping cart page
    updateItem(current, item){
        $(current).parent().siblings('.total-col').text('$' +item.current.total);
    },
    // update item in shopping cart nav bar
    updateTagItem(id, qty){
        let items = $('#'+cartItems).children();
        for (let i=0; i<items.length;i++)
            if (parseInt(items[i].getAttribute("value")) - id === 0)
                $(items[i]).find("span").eq(-1).text(qty);
    },

},

main.cart={
    addToCart:async(id)=>{
        let cart = await api.cart.postItem("/item/add", {product_id:id});
        html.cart.updateTagTotal(cart.total,cart.count );
        cart.current.isNew ?
            html.cart.showTagItem(cart.current):
            html.cart.updateTagItem(cart.current.id, cart.current.qty);
    },
    removeFromCart:async(current,cart)=>{
        html.cart.updateTagTotal(cart.total,cart.count );
        html.cart.updateView(cart);
        $(current).closest('.productselector').remove()
        $(current).closest("tr").remove()
    },
    getShippingValue(){
        let shipping = 'free'
        if($('#standart-shipping').is(':checked'))
            shipping = 'standart'
        if($('#express-shipping').is(':checked'))
            shipping = 'express'
        return shipping;
    },
}
buttons.cart={
    addToCart: document.addEventListener('click', async e=>{
            if (e.target && e.target.matches(".btn-product")){
                let id = e.target.id;
                main.cart.addToCart(id);
                //montrer le panier
                $('.cart-dropdown .dropdown-menu').css({
                    "visibility" : 'visible',
                    "opacity" : "1"
                })
                //cacher le panier après 3 secondes
                setTimeout(function(){
                    $('.cart-dropdown .dropdown-menu').css("visibility" , "");
                    $('.cart-dropdown .dropdown-menu').css("opacity" , "");
                    }, 3000)
            }
        }),
    removeFromCart: $(document.body).on('click','.btn-cart-remove', async function(){
            let cart = await api.cart.postItem("/item/remove", {product_id:$(this).attr("value")});
            main.cart.removeFromCart(this, cart);
            html.cart.checkEmpty(cart);
        }),
    setQty  : $('.'+qtyInput).on('change', async function(){
        let item = await api.cart.postItem("/item/update", 
            {
                product_id:$(this).closest('.quantity-col').siblings('.product-col').attr("value"),
                product_qty:$(this).val()
            });
        html.cart.updateView(item);
        html.cart.updateItem(this, item);

        }),
    setShipping : $('#free-shipping,#standart-shipping,#express-shipping').change( async()=>{
        let cart = await api.cart.postItem("/item/shipping/", {shipping:main.cart.getShippingValue()})
        console.log(cart)
        html.cart.updateView(cart);
    })

    }



