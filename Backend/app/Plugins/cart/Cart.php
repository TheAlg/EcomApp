<?php

namespace Base\Plugins;

use Phalcon\Session\Manager as Session;
use Base\Plugins\Builder;
class Cart
{

    public array $content = [];
    private Session $session;
    private Builder $productBuilder;

    public function __construct(Session $session) //default
    {

        $this->instance = 'shop'; 
        //keep the order
        $this->session = $session; //1
        $this->getContent();//2
        $this->total = $this->getTotal();
        $this->count = $this->getCount();
        $this->productBuilder = new Builder();
    }

    public function getContent()
    {
        $this->session->has($this->instance) ?: 
            $this->session->set($this->instance, $this->content);

        $this->content = $this->session->get($this->instance);
        return $this;
    }

    public function add(int $id)
    {
        $product = $this->productBuilder->findById($id);
        if (!$product) return false;
        //add to content
        if (array_key_exists($product->id, $this->content)) 
            $this->content[$product->id]->qty +=1;
        else {
            $product->qty =1;
            $this->content[$product->id] = $product;
        }
        //then set to session
        $this->session->set($this->instance, $this->content);
        $this->refresh();
        return $this;
    }

    public function remove(int $id)
    {
        for ($i=0; $i< count($this->content); $i++)
            if ($this->content[$id]){
                unset($this->content[$id]);
                $this->session->set($this->instance, $this->content);
                $this->refresh();
                return $this;
            }
        return false;
    }

    public function update(int $id, int $qty)
    {
        if (isset($id) && isset($dty)){
            for ($i=0; $i< count($this->content); $i++)
                if ($this->content[$id]){
                    $this->content[$id]->qty = $qty;
                    $this->session->set($this->content);
                    $this->refresh();
                    return $this;
                }
            }
        return false;
    }
    
    public function refresh(){
        $this->total = $this->getTotal();
        $this->count = $this->getCount();
    }

    public function getTotal() 
    {
        $total = 0;
        foreach ($this->content as $id => $product){
            $total += $product->price * $product->qty;
        }
        return $this->numberFormat($total, 2);
    }
    
    public function getCount()
    {
        return count($this->content);
    }

    public function destroy()
    {
        $this->session->remove($this->instance);
    }

    private function numberFormat($value,$decimals = 2,$decimalPoint = '.',$thousandSeperator = ' ')
    {
        return number_format($value, $decimals, $decimalPoint, $thousandSeperator);
    }



}
