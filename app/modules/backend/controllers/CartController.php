<?php
declare(strict_types=1);
namespace App\Backend\Controllers;

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Simple;
use Base\Plugins\CartItem;
use App\Application\Models\Products;
use App\Backend\Controllers\IndexController;


class CartController extends IndexController
{

public function addToCartAction()
{
    $this->view->disable();
    
    //checking if post
    if (!$this->request->isPost()) 
        {return $this->response->redirect('/');} 
    //add cart
    $cart = $this->cart->instance('cart')
                ->add($this->request->getPost());
    $response = $this->response->setContent($cart);
    $response->send();
}


public function removeItemAction() {
    $this->view->disable();
    if (!$this->request->isPost()) 
        {return $this->response->redirect('/items');} 
    $idproduit = $this->request->getPost('product_id');
    $cart = $this->cart->instance('cart')->remove($idproduit);
    //response
    $response = $this->response->setContent($cart);
    return $response;
    }

}

