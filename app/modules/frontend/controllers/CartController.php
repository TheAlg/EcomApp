<?php
declare(strict_types=1);

namespace App\Frontend\Controllers;
use Base\App\ControllerBase;


class CartController extends ControllerBase
{

    public function initialize(){
        $this->view->items = $this->cart->instance('cart')->content();
    }
    public function indexAction(): void
    {
    }
}