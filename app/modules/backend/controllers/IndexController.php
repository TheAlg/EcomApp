<?php
declare(strict_types=1);
namespace App\Backend\Controllers;

use Phalcon\Mvc\Controllers;
use Phalcon\Mvc\View;
use Base\App\ControllerBase;
use App\Application\Models\Banners;
use Base\Plugins\ProductsFinder;

class IndexController extends ControllerBase
{

    public function indexAction() 
    {
        $this->view->banners = Banners::find([
                'conditions' => 'startDate <= \'' . date("Y-m-d H:i:s") .'\' And startDate <= \'' . date("Y-m-d H:i:s") .'\'',
        ]);
        $this->view->categories = $this->products->getFilters();
        $this->view->allProducts = $this->products->execute();


    }
    
}

