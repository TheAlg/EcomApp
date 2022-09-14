<?php
declare(strict_types=1);

namespace App\Frontend\Controllers;
use Base\App\ControllerBase;


class ProductsController extends ControllerBase
{
    public function initialize(): void
    {
        $this->assets->collection('footerjs')->addJs('assets/js/app/items.js', true);
        $this->assets->collection('footerjs')->addJs('assets/js/app/filters.js', true);
        $this->assets->collection('footerjs')->addJs('assets/js/app/cart.js', true);
    }
    public function indexAction(): void
    {
        $this->assets->collection('footerjs')->addJs('assets/js/app/main.js', true);
    }
    public function getproductsAction(){
    }
}                
