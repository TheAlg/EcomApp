<?php

namespace Base\Plugins;

use Phalcon\Session\Manager as Session;
use Base\Plugins\ProductsFinder;

class Cart
{
    protected const DEFAULT = 'shop';

    public Item $cart;
    private $session;
    private $cartSession;
    public $shippingOptions;
    public $shippingFees;

    public function __construct(Session $session, $name=null) //default
    {
        $this->session      = $session;
        $this->name         = isset($name)? $name: self::DEFAULT;
        $this->cartSession  = $this->cartSession();
        $this->content      = $this->content();
        $this->shippingOptions = [
            'free'      =>   $this->numberFormat(0,2),
            'standart'  =>   $this->numberFormat(10,2),
            'express'   =>   $this->numberFormat(20,2),
        ];
        $this->shippingFees = $this->cartSession->getShippingFees(); 
        $this->shippingOption = $this->cartSession->getShippingOption();
        $this->total        = $this->total(2);
        $this->subTotal     = $this->subtotal(2);
        $this->count        = $this->count();
    }

    public function content()
    {
        if (is_null($this->session->has($this->name))) 
            $this->session->set($this->name, new Content());
        return  ($this->session->has($this->name)) ?
            $this->session->get($this->name)->getItems() :
            [];
    }

    public function setShipping(string $key){
        $value = $this->shippingOptions[$key]; 
        $this->cartSession->setShippingFees($key, $value);

        $this->refresh();
        return json_encode($this);
    }

    protected function cartSession()
    {
        $this->session->has($this->name) ? 
            $this->session->get($this->name): 
            $this->session->set($this->name, new Content());
        return $this->session->get($this->name);
    }

    public function refresh(){
        $this->content      = $this->content();
        $this->total        = $this->total(2);
        $this->subTotal     = $this->subtotal(2);
        $this->count        = $this->count();
        $this->shippingFees = $this->cartSession->getShippingFees();
        $this->shippingOption = $this->cartSession->getShippingOption();

        $this->session->set($this->name, $this->cartSession);
    }

    public function add(int $id)
    {
        $product = (new ProductsFinder())->set(
            ['product_id' => $id])->getFirst();
        if (!isset($id)) 
            throw new NotFoundException("product id : ". $id .' is inccorect');
        $item = new Item($product);
        if ($this->cartSession->has($item->rowId)){
            $item->qty += $this->cartSession->get($item->rowId)->qty;
            $item->isNew = false;
        }
        $this->current = $item;
        $this->cartSession->put($item->rowId, $item);
        $this->refresh();
        return json_encode($this);
    }
    public function remove(int $id)
    {
        $item = $this->get($this->getRowId($id));
        $this->cartSession->pull($item->rowId);
        $this->refresh();
        return json_encode($this);
    }
    public function update(int $id, int $qty)
    {
        if ($id === 0 ) return json_encode($this);
        $item       = $this->get($this->getRowId($id));
        $item->qty  = $qty;
        
        if ($qty <= 0) 
            $this->remove($id);
        else
            $this->cartSession->put($item->rowId, $item);
        $this->current = $item;
        $this->current->total= $this->numberFormat($qty * $item->price, 2);

        $this->refresh();
        return json_encode($this);
    }

    public function get($rowId)
    {
        if (!$this->cartSession->has($rowId)) {
            throw new NotFoundException(
                "The cart does not contain rowId {$rowId}."
            );
        }
        return $this->cartSession->get($rowId);
    }


    public function getRowId($id, array $options =[]) {
        ksort($options);
        return md5($id . serialize($options));
    }


    public function total($decimals = null,$decimalPoint = null,$thousandSeperator = null) 
    {
        $total = $this->cartSession->reduce(function ($total, Item $item) {
            return  $total + ($item->qty * str_replace(',','',$item->price));
        }, 0);

        return $this->numberFormat(
            $total + $this->cartSession->getShippingFees(),
            $decimals,
            $decimalPoint,
            $thousandSeperator
        );
    }

    public function subtotal($decimals = null,$decimalPoint = null,$thousandSeperator = null) 
    {
        $subTotal = $this->cartSession->reduce(function ($subTotal, Item $item) {
            return $subTotal + ($item->qty * $item->priceHT);
        }, 0);

        return $this->numberFormat(
            $subTotal,
            $decimals,
            $decimalPoint,
            $thousandSeperator
        );
    }

    
    public function countTotal()
    {
        $content = $this->getCartContent();

        $count = $content->reduce(function ($count, Item $cartItem) {
            return $count + $cartItem->qty;
        }, 0);

        return $count;
    }

    public function count()
    {
        return $this->cartSession->count();
    }


    public function destroy()
    {
        $this->session->remove($this->instance);
    }

    private function numberFormat($value,$decimals = 2,$decimalPoint = '.',$thousandSeperator = ',')
    {
        return number_format($value, $decimals, $decimalPoint, $thousandSeperator);
    }



}
