<?php
declare(strict_types=1);

namespace App\Frontend\Controllers;
use Base\App\ControllerBase;

/**
 * Display the "About" page.
 */
class IndexController extends ControllerBase
{
    public function indexAction(): void
    {
        $this->assets->collection('footerjs')->addJs('assets/js/app/index.js', true);              
        //$this->view->logged_in = is_array($this->auth->getIdentity());
    }
}