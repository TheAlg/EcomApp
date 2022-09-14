<?php

namespace Base\Plugins;

class Content
{
    protected $content = [];
    protected $shippingFees = 0;
    protected $shippingOption ='free';  

    public function setShippingFees($key, $value)
    {
        $this->shippingOption = $key;
        $this->shippingFees = $value;
    }
    public function getShippingFees()
    {
        if (count($this->content) === 0){
            $this->shippingFees =0;
        }
        return $this->shippingFees;
    }
    public function getShippingOption()
    {
        if (count($this->content) === 0){
            $this->shippingOption ='';
        }
        return $this->shippingOption;
    }

    public function has($key_item)
        {
            return array_key_exists($key_item, $this->content);
        }

    public function put($key_item, $item)
        {
            $this->content[$key_item] = $item;
        }

    public function get($key_item)
        {
            return $this->content[$key_item];
        }

    public function getItems()
        {
            return array_values($this->content);
        }

    public function pull($key_item)
        {
            unset($this->content[$key_item]);
            if (count($this->content) === 0)
                $this->shippingFees =0;
        }

    public function reduce(callable $callback, $initial = null)
        {
            return array_reduce($this->content, $callback, $initial);
        }

    public function count()
        {
            return count($this->content);
        }

}
