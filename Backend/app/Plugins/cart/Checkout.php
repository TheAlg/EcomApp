<?php

namespace Base\Plugins;
use Base\Plugins\Cart;

class Checkout
{

    private $shippingOptions = [
        'free'      =>   0,
        'standart'  =>   10,
        'express'   =>   20,
    ];

    public function __construct(Cart $cart)
    {    
        $this->shipping = $this->shippingOptions['free']; //default
        $this->cart = $cart;
        $total = $cart->getTotal() + $this->shipping;
        $this->total = $this->numberFormat($total);
        $this->count = $cart->getCount();
        $this->cartContent = $this->cartContent();
    }

    public function getContent(){
        return $this;
    }

    public function cartContent(){
        $result=[];
        foreach ($this->cart->getContent()->content as $item){
            array_push($result,[
                "name"=> $item->title,
                "price" => $item->price * $item->qty
            ]);
        }
        return $result;
    }


    public function setShipping(string $key){
        $this->setShipping = $this->shippingOptions[$key];
    }

    private function numberFormat($value,$decimals = 2,$decimalPoint = '.',$thousandSeperator = ' ')
    {
        return number_format($value, $decimals, $decimalPoint, $thousandSeperator);
    }

}
