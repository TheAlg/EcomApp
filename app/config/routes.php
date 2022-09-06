<?php
declare(strict_types=1);

use Phalcon\Mvc\Router;

/**
 * @var $router Router
 */

 //api
$router->addPost('/api/v1/items',
    [
        "module"     => "api",
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
//users


//cart
$router->addPost('/item/add', 
    [
        "module"     => "backend",
        'controller' => 'cart', 
        'action'     => 'addToCart'
    ]
);
$router->addPost('/item/remove', 
    [
        "module"     => "backend",
        'controller' => 'cart', 
        'action'     => 'removeItem'
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


//entries

/*$router->add('/confirm/{code}/{email}', [
    'controller' => 'user_control',
    'action'     => 'confirmEmail',
]);

$router->add('/reset-password/{code}/{email}', [
    'controller' => 'user_control',
    'action'     => 'resetPassword',
]);*/
