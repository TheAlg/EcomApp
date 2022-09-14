<?php
declare(strict_types=1);

namespace App\Api\Controllers;

use Phalcon\Mvc\View;
use Base\App\ControllerBase;

class ProductController extends ControllerBase
{

    public function indexAction()
    {
    }
    
    public function initialize() 
    {
    }

    public function getAllProductsAction() 
    {
        $this->view->disable();
        if ($this->request->isPost()){
            //passing queries 
            $results= $this->products->set($this->request->getPost())->execute();
            //sending response
            $this->response->setContent(json_encode($results))->send(); 
        }
    }

    public function getAllCategoriesAction() {
        $this->view->disable();   
        if ($this->request->isGet()){
            $results = $this->products->getFilters();
            $this->response->setContent(json_encode($results))->send();
        }
    }

    public function postItemAction(){
        $this->view->disable();
        $product = new product;
            $product->id = $this->request->getPost('id');
            $product->title = $this->request->getPost('title');
            $product->category = $this->request->getPost('category');
            $product->price = $this->request->getPost('price');
            $product->picture = $this->request->getPost('picture');
            $product->description = $this->request->getPost('description');
            $product->brand = $this->request->getPost('brand');
            $product->category = $this->request->getPost('category');


            $colors = $this->request->getPost('colors');
            if (is_string($colors))
                $colors = explode(' ', $colors);
            foreach($colors as $color){
                $colors =[];
                $colorsAvailable = new colors();
                $colorsAvailable->id = $product->id;
                $colorsAvailable->color = $color;
                //appending object
                array_push($colors, $colorsAvailable);
            }
            $sizes = $this->request->getPost('sizes');
            if (is_string($sizes))
                $sizes = explode(' ', $sizes);
            foreach($sizes as $sizes){
                $sizes =[];
                $sizesAvailable = new sizes();
                $sizesAvailable->id = $product->id;
                $sizesAvailable->size = $size;
                //appending object
                array_push($colors, $colorsAvailable);
            }
            $product->register($colors, $sizes);

        $response = new Response();
    return $response->setContent($product);
    }


    public function getProductAction()  {
            $id = $this->dispatcher->getParam('idproduit');
            $products = $this->items->findFirst($id);
            $this->view->setVar("data", $products);
    }
}