api.cart={
    postItem: async (id, route)=>{
        const result = await $.ajax({
            type: "POST", 
            url: route, 
            data: {product_id:id},
            error: function() {
                alert("problem communicating with server");
            } 
        });
        const data = await JSON.parse(result);
        return data;
    }
}    
html.cart={
    showCartItem(cart)	{	
        console.log(cart);
        DOMelements.productList.innerHTML +=
            "<div class='product productselector' value='"+ cart.item.productId+"'>\
                <div class='product-cart-details'>\
                    \<h4 class='product-title'>\
                        <a href='product.html'>"+cart.item.title+ "</a>\
                    \</h4>\
                    \<span class='cart-product-info'>\
                        \<span class='cart-product-qty'>"+ cart.item.qty 
                        +"</span> x  $"+ cart.item.price
                    +"</span>\
                \</div>\
                \<figure class='product-image-container'>\
                    \<a href='product.html' class='product-image'>\
                        \<img src='"+cart.item.picture+"'alt='product'>\
                    \</a>\
                \</figure>\
                \<a class='btn-remove removeProduct' type= 'submit' value='"+cart.item.productId+"'  title='Remove Product'><i class='icon-close'></i></a>\
            \</div>"
        
    },
    updateCart(price,count){
        DOMelements.totalPrice .textContent = price;
        DOMelements.totalCount.textContent = count;
    },
    updateCartItem(id, qty){
        let items = DOMelements.productList.children;
        for (let i=0; i<items.length;i++){
            if (items[i].getAttribute("value") === id){
                $(items[i]).find("span").eq(-1).text(qty);
            }
        }
    },
}

main.cart={
    addToCart:async(id)=>{
        let item = await api.cart.postItem(id, "/item/add");
        html.cart.updateCart(item.price,item.count );
        item.isNew ?
            html.cart.showCartItem(item):
            html.cart.updateCartItem(id, item.item.qty);
    },
    removeFromCart:async(id)=>{
        let item = await api.cart.postItem(id, "/item/remove");
        html.cart.updateCart(item.price,item.count );
    },
}
buttons.cart={
    addToCart: document.addEventListener('click', async e=>{
            if (e.target && e.target.matches(".btn-product")){
                let id = e.target.id;
                console.log(id)
                main.cart.addToCart(id);
            }
        }),
    removeFromCart: document.addEventListener('click', async e=>{
            if (e.target && e.target.matches(".btn-remove,.removeProduct")){
                let id = e.target.getAttribute("value");
                main.cart.removeFromCart(id);
                e.target.parentElement.remove();
            }
        }),
}

buttons.cart.addToCart;
buttons.cart.removeFromCart;