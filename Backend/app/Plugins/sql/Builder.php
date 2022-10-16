<?php

namespace Base\Plugins;

use Phalcon\Mvc\Model\Query\Builder as modelsBuilder;
use App\Application\Models\Products as ProductsModel;
use App\Application\Models\ProductPricing;
use App\Application\Models\Categories;
use App\Application\Models\Colors;
use App\Application\Models\Sizes;

class Builder
{    
    public $filters =[
        [
            "className" => "Categories",
            "columnName"=> "name"
        ],
        [
            "className" => "Colors",
            "columnName"=> "color"
        ],       [
            "className" => "Sizes",
            "columnName"=> "size"
        ],
    ];
    
    public $selectedFilters=[];
    public $products=[];
    private modelsBuilder $builder;

    public function __construct()
    {
        $this->builder = new modelsBuilder();

    }


    public function getProducts(array $params = null)
    {
        $this->builder
            ->columns(' DISTINCT product.id, title, subtitle, description, name as category, picturePath as picture ,expiry_date, basePrice as price, new, sale, top')
            ->addFrom(ProductsModel::class,"product")
            ->join(ProductPricing::class, 'price.productId = product.id', 'price')
            ->join(Categories::class, 'categoryId = category.id', 'category')
            ->andWhere('inActive = \'Y\'')
            ->orderBy('product.id');

        if (isset($params)){
            foreach($params as $key => $value){
                $this->$key = $value;
            }
            $this->updateBuilder();
        }
        return $this->builder->getQuery()->execute();
    }

    public function findById(int $id)
    {
        return $this->builder
            ->columns(' DISTINCT product.id, title, subtitle, description, name as category, picturePath as picture ,expiry_date, basePrice as price, new, sale, top')
            ->addFrom(ProductsModel::class,"product")
            ->join(ProductPricing::class, 'price.productId = product.id', 'price')
            ->join(Categories::class, 'categoryId = category.id', 'category')
            ->andWhere('product.id ='. $id)
            ->getQuery()
            ->getSingleResult();
    }
    
    public function categories() // problem maybe in the name of the function 
    {
        foreach($this->filters as $filter){
            array_push($this->selectedFilters, [
                "name"      => $filter["className"],
                "children"  =>  $this->builder
                                    ->columns('distinct ' .$filter["columnName"] .' as name')
                                    ->from('App\Application\Models\\'.$filter["className"])
                                    ->getQuery()
                                    ->execute()
            ]);
    
        }
        return $this->selectedFilters;
    }
    
    public function updateBuilder() : void
    {
        //id
        if (isset($this->id))
            $this->builder->andWhere('product.id ='. $this->id);
        //max 
        if (isset($this->maxPrice))
            $this->builder->andWhere('basePrice <' . $this->maxPrice);
        //categories
        if (isset($this->Categories) && is_array($this->Categories))
            $this->builder->inWhere('name', $this->Categories);
        //colors
        if (isset($this->Colors)  && is_array($this->Colors))
            $this->builder
                ->join(Colors::class, 'color.productId = product.id', 'color')
                ->inWhere('color', $this->Colors);
        //sizes
        if (isset($this->Sizes) && is_array($this->Sizes))
            $this->builder
                ->join(Sizes::class, 'size.productId = product.id', 'size')
                ->inWhere('size', $this->Sizes);
    }

    /*public function oldPrice(){
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

    public function setQueries(array $params)
    {
 
        //sanitizers
        $this->id = is_numeric($params['id']) ? $params['id']:null;
        $this->max= is_numeric($params['maxPrice'])?  $params['maxPrice']:null;

        $this->category = is_array($params['category'])? $params['category']: null;
        $this->colors = is_array($params['color']) ? $params['color']: null;
        $this->sizes = is_array($params['size'])?  $params['size']: null;
        return $this;
    }*/
}