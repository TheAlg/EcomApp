<?php

namespace Base\Plugins;

use Phalcon\Mvc\Model\Query\Builder;
use App\Application\Models\Products as ProductsModel;
use App\Application\Models\ProductPricing;
use App\Application\Models\Categories;
use App\Application\Models\Colors;
use App\Application\Models\Sizes;

class ProductsFinder extends \Phalcon\Mvc\Model
{    
    protected $min;
    protected $max;
    protected $categories;
    protected $colors;
    protected $sizes;
    protected $id;

    public function set(array $params)
    {
        //sanitizers
        $this->id = isset($params['product_id']) && is_numeric($params['product_id']) ?
                    $params['product_id']:null;
        $this->min = isset($params['min']) && is_numeric($params['min']) ?
                    $params['min']:null;
        $this->max= isset($params['max']) && is_numeric($params['max']) ? 
                    $params['max']:null;
        $this->categories =  isset($params['category']) && is_array($params['category'])? 
                    $params['category']: null;
        $this->colors = isset($params['color']) && is_array($params['color']) ? 
                    $params['color']: null;
        $this->sizes = isset($params['size']) && is_array($params['size'])? 
                    $params['size']: null;
        return $this;
    }
    public function execute()
    {
        //query
        $query = new Builder(null, $this->getDi());
        $query->columns(' DISTINCT product.id, title, subtitle, description, name as category, picturePath as picture ,expiry_date, basePrice as price, new, sale, top')
                ->addFrom(ProductsModel::class,"product")
                ->join(ProductPricing::class, 'price.productId = product.id', 'price')
                ->join(Categories::class, 'categoryId = category.id', 'category')
                ->andWhere('inActive = \'Y\'')
                ->orderBy('product.id');
        //id
        if (isset($this->id))
        $query
            ->andWhere('product.id ='. $this->id);
        //min
        if (isset($this->min))
            $query
                ->andWhere('basePrice >'. $this->min);
        //max 
        if (isset($this->max))
            $query
                ->andWhere('basePrice <' . $this->max);
        //categories
        if (isset($this->categories))
            $query
                ->inWhere('name',$this->categories);
        //colors
        if (isset($this->colors))
            $query
                ->join(Colors::class, 'color.productId = product.id', 'color')
                ->inWhere('color', $this->colors);
        //sizes
        if (isset($this->sizes))
            $query
                ->join(Sizes::class, 'size.productId = product.id', 'size')
                ->inWhere('size', $this->sizes);

        //executing query
        $params = $query->getQuery()->execute();

        //joining colors and sizes
        $list=[];
        foreach($params as $product){
            $item   = new \StdClass;
            foreach(get_object_vars($product) as $key => $value){
                if ($key === 'price') $item->$key = number_format($value, 2);
                else $item->$key = $value;

            };
            $item->colors       = $this->fetch(Colors::class, 'color', $product['id']);  
            $item->sizes        = $this->fetch(Sizes::class, 'size', $product['id']);          
            array_push($list, $item);
        }
        return array_values($list);
    }
    public function getFirst(){
        //query
        if (isset($this->id)){
            return $this->modelsManager->createBuilder()
                    ->addFrom(ProductsModel::class,"product")
                    ->columns('product.id, title, subtitle, description, name as category, picturePath as picture ,basePrice as price, new, sale, top')
                    ->andWhere('product.id = '. $this->id)
                    ->andWhere('inActive = \'Y\'')
                    ->join(ProductPricing::class, 'price.productId = product.id', 'price')
                    ->join(Categories::class, 'categoryId = category.id', 'category')
                    ->getQuery()
                    ->getSingleResult();    
        }
        return false;
    }
    public function getFilters(){
        $object = new \stdClass;
        $object->categories =  $this->fetch(Categories::class, 'name');
        $object->colors = $this->fetch(Colors::class, 'color');
        $object->sizes = $this->fetch(Sizes::class, 'size');
        return $object;
    }
    
    public function oldPrice(){
        //query
        $query = new Builder(null, $this->getDi());
        return $query->columns('basePrice as price')
                ->addFrom(ProductsModel::class,"product")
                ->join(ProductPricing::class, 'price.productId = product.id', 'price')
                ->join(Categories::class, 'categoryId = category.id', 'category')
                ->andWhere('inActive = \'L\'')
                ->andWhere('product.id ='. $this->id)
                ->orderBy('product.id')
                ->getQuery()
                ->getSingleResult();
    }

    public function fetch(string $class, string $target, $whereTarget = null){
        $results = [];
        $query = new Builder(null, $this->getDi());
        $query  ->addFrom($class)
                ->columns('distinct ' .$target);
        if (isset($whereTarget))
            $query->where('productId =' . $whereTarget);

        $set = $query->getQuery()->execute();
        foreach ($set as $key=>$value){
            array_push( $results, $value[$target]);
        }
        return $results;
    }


}