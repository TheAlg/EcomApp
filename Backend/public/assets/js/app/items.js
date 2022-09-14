DOMelements.paginationContainer = document.getElementById('pagination');
DOMelements.paginationPages = document.getElementsByClassName('page-navigation')
api.items={
    getItems : async(route, params)=>{

        const result =  await $.ajax({
            type: "POST", 
            url: baseUrl + route, 
            data: params,
        });
        const data = JSON.parse(result);
        return data;

        /*const result = await fetch(baseUrl + route, {
            method: 'POST',
            body: params,
            headers: {
                'Accept': 'application/json',
                'Content-Type' : 'application/x-www-form-urlencoded', 
            },
        });
        const data = await result.json();
        return data;*/
    },
}
html.items={
    showOldPrice : (oldprice) => { 
        return "<span class='old-price'> $"+ oldprice + "</span>";
    },
    showPromotionPercentage : (percentage)=>{
        return "<span class='product-label label-sale'>" + percentage + "% off</span>";
    },
    showRatings :()=>{
        return "<div class='ratings-container'> <div class='ratings'>\
                        <div class='ratings-val' style='width: 40%;'></div>\
                    </div>\
                    <span class='ratings-text'>( 4 Reviews )</span></div>";
    },
    showItemImage: (src, addlink,showlink, value)=>{
        return "<figure class='product-media'>"+
            //<span class='product-label label-new'>New</span>
            "<a href='"+showlink+"'>\
                <img src='"+src+"' alt='Product image' class='product-image'>\
            </a>\
            <div class='product-action-vertical'>\
                <a href='#' class='btn-product-icon btn-wishlist btn-expandable'><span>add to wishlist</span></a>\
                <a href='"+addlink+"' class='btn-product-icon btn-quickview' title='Quick view'><span>Quick view</span></a>"+
                //<a href='#' class='btn-product-icon btn-compare' title='Compare'><span>Compare</span></a>
            "</div>\
            <div class='product-action' type='submit'>\
                <a type='submit' class='btn-product btn-cart' id='"+value+"'><span>add to cart</span></a>\
            </div>\
        </figure>"
    },

    showItems: async (items) =>
    {      

        DOMelements.products.innerHTML=
        `<div class="row justify-content-center"></div>`
        
        if (items.length===0)
        DOMelements.products.firstChild.innerHTML+= `
                <div class="void heading heading-center">
                    <div class="heading-left">
                        <h2 class="title">Sorry, no product matches your criteria.</h2>
                        <h4 class="title-desc"> checkout our similar products </h4>
                    </div>
                    <div class="heading-right">
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" data-toggle="tab" role="tab" aria-selected="true">All Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="tab" role="tab" aria-selected="false">Women</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="tab" role="tab" aria-selected="false">Men</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="tab" role="tab" aria-selected="false">Accessories</a>
                            </li>
                        </ul>
                    </div>
                </div>
                    `;
        else
        for (let i =0; i<items.length; i++) {
            let addItemUrl = '/items/'+ items[i].id;
            let showItemUrl = '/items/'+ items[i].id;
            DOMelements.products.firstChild.innerHTML+=
                "<div class='col-6 col-md-4 col-lg-4'>\
                    <div class='product product-7 text-center'>"+
                        html.items.showItemImage(items[i].picture, addItemUrl,showItemUrl,items[i].id) +
                        "<div class='product-body'>\
                            <div class='product-cat'> <a href='" +/*categoryLink*/ +"'>" + items[i].category + "</a> </div>\
                            <h3 class='product-title'><a href='" + showItemUrl +"'>" + items[i].title + "</a></h3>\
                            <div class='product-price'> $ "+ items[i].price+ "</div>" +
                            //this.showOldprice(oldprice)+
                            //this.showRatings()+
                            //this.showColors()+
                        "</div>\
                    </div>\
                </div>";
        }
    },

    template: (items) =>
    {     
        var content =''
        for (let i =0; i< items.length; i++) {
            let addItemUrl = '/items/'+ items[i].id;
            let showItemUrl = '/items/'+ items[i].id;
            content +=
                `<div class='col-6 col-md-4 col-lg-4'>
                    <div class='product product-7 text-center'>
                        ${html.items.showItemImage(items[i].picture, addItemUrl,showItemUrl,items[i].id)}
                        <div class='product-body'>
                            <div class='product-cat'> <a href=''> ${items[i].category} </a> </div>
                            <h3 class='product-title'><a href='${showItemUrl}'>${items[i].title}</a></h3>
                            <div class='product-price'> $ ${items[i].price} </div>
                        </div>
                    </div>
                </div>`;
        }
        return content
    },
    resetItems: ()=> {
        if ( DOMelements.products.children.length > 0)
        DOMelements.products.innerHTML ='';
    },
    resetPagination(){
        if (DOMelements.paginationPages.length == 0) return;
        DOMelements.paginationPages[0].remove()
        
    },
    showTotalItems:(pagination)=>{
        var html = `<div class="toolbox" id="toolbox-info-container">
                            <div class="toolbox-left">
                                <div class="toolbox-info" id ='toolbox-info'></div>
                            </div>  
                        </div>`;
        //add div if not exists
        console.log($('#toolbox-info-container'))
        if ($('#toolbox-info-container').length == 0){
            $('#shop-container').prepend(html)
        }
        $('#toolbox-info').html('Showing <span>' + pagination.totalNumber +'</span> Products')
    },
    showNoItemsAvailable(){
        $('#toolbox-info-container').remove();
        $('#shop-container').prepend('<div class="mb-7"></div>')
        
        DOMelements.products.innerHTML +=
        `
        <div class="void heading heading-center">
            <div class="heading-left">
                <h2 class="title">Sorry, no product matches your criteria.</h2>
                <h4 class="title-desc"> checkout our similar products </h4>
            </div>
            <div class="heading-right">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-toggle="tab" role="tab" aria-selected="true">All Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="tab" role="tab" aria-selected="false">Women</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="tab" role="tab" aria-selected="false">Men</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="tab" role="tab" aria-selected="false">Accessories</a>
                    </li>
                </ul>
            </div>
        </div>
            `
    }
}
main.items={
    showData :async(data)=>{
        $('#pagination').pagination({
            dataSource: data,
            pageSize: 12,
            ulClassName:'pagination justify-content-center',
            callback: function(response, pagination) {
                let dataHtml = html.items.template(response);
                $('#data-container').html(dataHtml);
                html.items.showTotalItems(pagination)
            }
        })
    },
   items:async(params = '')=>{
        html.items.resetItems();  
        html.items.resetPagination(); 
        let items = await api.items.getItems('/api/v1/items', params);
        if (items.length == 0) 
            html.items.showNoItemsAvailable()
        else
            main.items.showData(items);
    },
}


window.onload = main.items.items();


