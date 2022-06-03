<?php

namespace App\Application\Models;
;
class Sizes extends \Phalcon\Mvc\Model
{

    public function initialize()
    {
        $this->hasOne('productId', Products::class, 'id', [
            'alias'      => 'products',
            'foreignKey' => [
                'message' => 'products fk ',
            ],
        ]);

    }

}
