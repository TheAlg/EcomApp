<?php

namespace Base\Plugins;

class CartContent
{


    protected $items = [];


    public function has($key_item)
        {
            return array_key_exists($key_item, $this->items);
        }

    public function put($key_item, $item)
        {
            $this->items[$key_item] = $item;
        }

    public function get($key_item)
        {
            return $this->items[$key_item];
        }

    public function getItems()
        {
            return $this->items;
        }

    public function pull($key_item)
        {
            unset($this->items[$key_item]);
        }

    public function reduce(callable $callback, $initial = null)
        {
            return array_reduce($this->items, $callback, $initial);
        }

    public function count()
        {
            return count($this->items);
        }
}
