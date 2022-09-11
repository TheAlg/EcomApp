<?php

namespace App\Application\Models;

class ProductPricing extends \Phalcon\Mvc\Model 
{
    public function initialize()
    {
        $this->setSource('productPricing');
        $this->hasOne('productId', Products::class, 'id', [
            'alias'    => 'products',
            'reusable' => true,
        ]);
    }

}
