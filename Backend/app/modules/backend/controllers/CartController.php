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

    public function initialize()
    {
        $this->view->disable();
    }

    public function addToCartAction()
    {
        //checking if post
        if (!$this->request->isPost()) 
            {return $this->response->redirect('/');} 
        //add cart
        $cart = $this->cart->add($this->request->getPost('product_id', 'int', null));

        $response = $this->response->setContent($cart);
        $response->send();
    }
    
    public function removeItemAction() 
    {
        if (!$this->request->isPost()) 
            {return $this->response->redirect('/cart');} 

        $cart = $this->cart->remove($this->request->getPost('product_id', 'int', null));
        //response
        $response = $this->response->setContent($cart);
        return $response;
    }

    public function updateItemAction() 
    {
        if (!$this->request->isPost()) 
            return $this->response->redirect('/cart');

        $id = $this->request->getPost('product_id', 'int', 0);
        $qty = $this->request->getPost('product_qty', 'int', 1);
        $cart = $this->cart->update($id, $qty);
        //response
        $response = $this->response->setContent($cart);
        return $response;
    }
    public function shippingAction()
    {
        if (!$this->request->isPost()) 
        return $this->response->redirect('/cart');

        $shipping = $this->request->getPost('shipping', 'striptags', 'free');
        $cart = $this->cart->setShipping($shipping);
        //response
        $response = $this->response->setContent($cart);
        return $response;
    }
    public function refreshAction()
    {
        $this->cart->refresh();
        $this->response->redirect('/cart');
    }

    


}



