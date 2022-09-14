<?php
declare(strict_types=1);

namespace App\Frontend\Controllers;
use Base\App\ControllerBase;


class CartController extends ControllerBase
{

    public function initialize(){
        $this->view->controllerName = $this->dispatcher->getControllerName();

    }
    
    public function indexAction(): void
    {
    }
}