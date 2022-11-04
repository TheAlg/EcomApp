
const publicUrl = 'http://localhost:8000';

export const API = {
    cart : {
        get     : publicUrl+'/cart/getCart',
        add     : publicUrl+'/cart/add',
        remove  : publicUrl+'/cart/remove',
    },
    auth: {
        login   : publicUrl +'/auth/login',
        singup     : publicUrl+'/auth/signup',
        forgetPassword : publicUrl +'/auth/forgetPassword',
        changePassword : publicUrl + '/auth/changePassword',
        logout  : publicUrl+'/auth/logout'
    },
    user : {
        get     : publicUrl+'/user',
        address : publicUrl+'/user/address',
        update  : publicUrl+'/user/update/',
        payment : publicUrl+'/user/payement',

    },
    checkout :{
        get : publicUrl+'/checkout/getcontent/',
    },
    products :{
        products    : publicUrl+'/api/v1/items',
        categories  : publicUrl+'/api/v1/categories'
    }



}