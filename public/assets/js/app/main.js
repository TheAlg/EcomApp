const baseUrl = 'http://ecommerce.test'
const currentUrl = window.location.href;
const DOMelements = {
    products : document.getElementById('items'),
    filters : document.getElementById('filters'),
    totalCount : document.getElementById('cartCount'),
    totalPrice : document.getElementById('cart-total-price'),
    productList : document.getElementById("cart_items"),
    header: document.querySelectorAll("header_navs"),
}
const api = {
    main:{
    },
}
const html ={
    main:{
    },
}
const main = {
    main:{
    },
}
const init={
    main:{
        headerNavs : () => {
            if (currentUrl.includes('/products'))
                document.getElementById('header_shop').classList.add('show')
            else if (currentUrl.includes('/about'))
                document.getElementById('header_about').classList.add('show')
            else if (currentUrl.includes('/contact'))
                document.getElementById('header_contact').classList.add('show')
            else 
                document.getElementById('header_index').classList.add('show')
        }
    }
}
const buttons ={
}

init.main.headerNavs();


const helpers = {
    capitalizeFirstLetter:(string) =>{
       return string.charAt(0).toUpperCase() + string.slice(1);
   },
   encode:(array)=>{
       let params = '?';
       for ([key, value] of Object.entries(array)){   
           let val = value.split(',')
           if (val.length ===1){
               params.slice(-1)==="?"? params: params+="&";
               params += key + "=" + encodeURIComponent(val[0])
           }
           else
           for (let i=0; i<val.length;i++){
               params.slice(-1)==="?"? params: params+="&";
               params+= key + "[]=" + encodeURIComponent(val[i])
           }
       }
       return params
               .replaceAll('brand','bd')
               .replaceAll('category', 'ctg')
               .replaceAll('size', 'sz');
   },
};