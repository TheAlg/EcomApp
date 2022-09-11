<?php

namespace App\Application\Models;

class Colors extends \Phalcon\Mvc\Model
{

    public function initialize()
    {
        $this->hasOne('productId', Products::class, 'id', [
            'alias'    => 'products',
            'reusable' => true,
        ]);
    }

}
