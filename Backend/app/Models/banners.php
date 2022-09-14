<?php

namespace App\Application\Models;

class Banners extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->setSource('banners');
    }

}
