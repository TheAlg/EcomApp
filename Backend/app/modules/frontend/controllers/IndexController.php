<?php
declare(strict_types=1);

namespace App\Frontend\Controllers;
use Base\App\ControllerBase;


class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->assets->collection('footerjs')->addJs('assets/js/app/index.js', true);  
        //forward to backend index  
        return true;           
        //$this->view->logged_in = is_array($this->auth->getIdentity());
    }
}