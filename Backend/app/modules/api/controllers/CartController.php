<?php
declare(strict_types=1);
namespace App\Api\Controllers;


use Base\App\ControllerBase;


class CartController extends ControllerBase
{

    public function addToCartAction()
    {
        $data = $this->getPost();
        return $this->cart->add((int)$data->id);
    }

    public function getCartAction(){
        return $this->cart->getContent();
    }
    
    public function removeAction() 
    {
        $data = $this->getPost();
        return $this->cart->remove((int)$data->id);
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



