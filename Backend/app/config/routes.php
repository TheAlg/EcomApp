<?php
declare(strict_types=1);

use Phalcon\Mvc\Router;

/**
 * @var $router Router
 */

 //AuthController
$router->addPost('/auth/signup',
[
    "module"     => "api",
    'controller' => 'auth',
    'action'     => 'signUp',        
]);
$router->addPost('/auth/login',
[
    "module"     => "api",
    'controller' => 'auth',
    'action'     => 'login',        
]);
$router->addPost('/auth/forgetPassword',
[
    "module"     => "api",
    'controller' => 'auth',
    'action'     => 'forgetPassword',        
]);
$router->addPost('/auth/logout',
[
    "module"     => "api",
    'controller' => 'auth',
    'action'     => 'logout',        
]);
$router->addPost('/auth/confirmEmail', [
    "module"     => "api",
    'controller' => 'Auth',
    'action'     => 'confirmEmail',
]);
$router->addPost('/auth/resetPassword', [
    "module"     => "api",
    'controller' => 'Auth',
    'action'     => 'resetPassword',
]);

$router->addPost('/auth/changePassword', [
    "module"     => "api",
    'controller' => 'Auth',
    'action'     => 'changePassword',
]);

//userControler
$router->addGet('/user',
[
    "module"     => "api",
    'controller' => 'user',
    'action'     => 'getUser',        
]);
$router->addGet('/user/address',
[
    "module"     => "api",
    'controller' => 'user',
    'action'     => 'getAddress',        
]);
$router->addPost('/user/address',
[
    "module"     => "api",
    'controller' => 'user',
    'action'     => 'postAddress',        
]);
$router->addDelete('/user/address/{id}',
[
    "module"     => "api",
    'controller' => 'user',
    'action'     => 'deleteAddress', 
    'id' => 1       
]);
$router->addPost('/user/update/', 
[
    "module"     => "api",
    'controller' => 'user', 
    'action'     => 'update'
]);
$router->addGet('/user/payement',
[
    "module"     => "api",
    'controller' => 'user',
    'action'     => 'getPayement',        
]);
$router->addPost('/user/payement',
[
    "module"     => "api",
    'controller' => 'user',
    'action'     => 'postPayement',        
]);



 //products
$router->addGet('/api/v1/items',
    [
        'controller' => 'product',
        'action'     => 'getAllProducts',
    ]
);
$router->addGet('/api/v1/categories',
    [
        "module"     => "api",
        'controller' => 'product',
        'action'     => 'getAllCategories',
    ]
);
$router->addGet('/api/v1/items/{idproduit:[0-9]+}',
    [
        "module"     => "api",
        'controller' => 'product',
        'action'     => 'getProduct',        
    ]
);


//cart
$router->addGet('/cart/get', 
    [
        "module"     => "api",
        'controller' => 'cart', 
        'action'     => 'getCart'
    ]
);
$router->addPost('/cart/add', 
    [
        "module"     => "api",
        'controller' => 'cart', 
        'action'     => 'addToCart'
    ]
);
$router->addPost('/cart/remove', 
    [
        "module"     => "api",
        'controller' => 'cart', 
        'action'     => 'remove'
    ]
);
$router->addPost('/item/update', 
    [
        "module"     => "backend",
        'controller' => 'cart', 
        'action'     => 'updateItem'
    ]
);
$router->addPost('/item/shipping/', 
    [
        "module"     => "backend",
        'controller' => 'cart', 
        'action'     => 'shipping'
    ]
);
$router->add('/item/refresh/', 
    [
        "module"     => "backend",
        'controller' => 'cart', 
        'action'     => 'refresh'
    ]
);

//checkoutController

$router->addGet('/checkout/getcontent/', 
    [
        "module"     => "api",
        'controller' => 'checkout', 
        'action'     => 'getContent'
    ]
);







