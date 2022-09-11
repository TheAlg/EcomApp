<?php
namespace App\Application\Models;

use Phalcon\Mvc\Model\Query;
use Base\Plugins\Builder;
use helpers\query\Transaction;
use App\Api\Models\Colors;
use App\Api\Models\Sizes;
use App\Api\Models\Categories;



class Products extends \Phalcon\Mvc\Model
{

    public function initialize()
    {
        $this->setSource('products');
        $this->hasOne('categoryId', Categories::class, 'id', [
            'alias'    => 'category',
            'reusable' => true,
        ]);
        $this->hasMany("id", Colors::class, "productId", [
            'alias'      => 'color',
            'reusable' => true,
            'foreignKey' => [
                'message' => 'products fk ',
            ],
        ]);
        $this->hasMany("id", Sizes::class, "productId", [
            'alias'      => 'sizes',
            'foreignKey' => [
                'message' => 'products fk ',
            ],
        ]);
        $this->hasMany("id", ProductPricing::class, "productId", [
            'alias'      => 'pricings',
            'foreignKey' => [
                'message' => 'products fk ',
            ],
        ]);
    }

    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }


    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }
    public function insertProduct(){

    }

    public function register(
        Array $colors = null,
        Array $sizes = null ) 
    {
        //start transition    

        foreach ($colors as $color );
        foreach ($sizes as $size );
        
        //executer la transaction

        }

}
