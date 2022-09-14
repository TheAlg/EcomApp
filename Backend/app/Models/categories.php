<?php

namespace App\Application\Models;

class Categories extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->hasMany('id', Products::class, 'productId', [
            'alias'    => 'product',
            'reusable' => true,
        ]);
    }

}
