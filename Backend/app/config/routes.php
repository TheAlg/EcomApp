<?php
declare(strict_types=1);

use Phalcon\Mvc\Router;

/**
 * @var $router Router
 */

 //SessionController
 $router->addPost('/',
[
    "module"     => "api",
    'controller' => 'product',
    'action'     => 'getAllProducts',       
]
);
$router->addPost('/auth/addUser',
[
    "module"     => "api",
    'controller' => 'Session',
    'action'     => 'signUp',        
]
);
$router->addPost('/auth/login',
[
    "module"     => "api",
    'controller' => 'Session',
    'action'     => 'login',        
]
);
$router->addPost('/auth/forgetPassword',
[
    "module"     => "api",
    'controller' => 'Session',
    'action'     => 'forgetPassword',        
]
);
$router->addPost('/auth/logout',
[
    "module"     => "api",
    'controller' => 'Session',
    'action'     => 'logout',        
]
);


//AuthController
$router->addGet('/auth/securityToken',
[
    "module"     => "frontend",
    'controller' => 'auth',
    'action'     => 'securityToken',        
]
);
$router->addPost('/auth/confirmEmail', [
    "module"     => "api",
    'controller' => 'Auth',
    'action'     => 'confirmEmail',
]
);
$router->addPost('/auth/resetPassword', [
    "module"     => "api",
    'controller' => 'Auth',
    'action'     => 'resetPassword',
]
);

$router->addPost('/auth/changePassword', [
    "module"     => "api",
    'controller' => 'Auth',
    'action'     => 'changePassword',
]
);



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








