<?php

namespace Base\Plugins;

use Phalcon\Session\Manager as Session;
use Base\Plugins\ProductsFinder;

class CartShopping
{
    protected const DEFAULT_IDENTIFICATOR = 'shop';

    public CartItem $cart;
    private $session;
    private $instance;
    private $logger;

    public function __construct(Session $session, $instance = null)
    {
        $this->session = $session;
        $this->instance($instance ?: self::DEFAULT_IDENTIFICATOR);
    }

    public function instance($instance = null)
    {
        $instance = $instance ?: self::DEFAULT_IDENTIFICATOR;
        $this->instance = sprintf('%s.%s', 'cart', $instance);
        return $this;
    }

    public function currentInstance()
    {
        return str_replace('cart.', '', $this->instance);
    }

    public function content()
    {
        if (is_null($this->session->has($this->instance))) {
            new CartContent();
        }

        return ($this->session->has($this->instance)) ?
            $this->session->get($this->instance)->getItems() :
            [];
    }

    protected function getCartContent()
    {
        $content = $this->session->has($this->instance)
            ? $this->session->get($this->instance)
            : new CartContent();
        return $content;
    }

    public function add(array $params)
    {
        /*if ($this->isMulti($productId)) 
        { return array_map(function ($item) {
                return $this->add($item);
            }, $productId);
        }*/
        $isNew = true;
        $qty = 1;
        $product = (new ProductsFinder())->set($params)->getFirst();
    

        $cartItem = new CartItem($product->id, $product->title,$product->picture, $product->price, $qty);
        //cart content
        $content = $this->getCartContent();

        if ($content->has($cartItem->rowId)){
            $cartItem->qty += $content->get($cartItem->rowId)->qty;
            $isNew = false;
        }
        //adding rowId to content
        $content->put($cartItem->rowId, $cartItem);
        //
        $this->session->set($this->instance, $content);

        return json_encode([
            'item'      => $cartItem,
            'count'     => $this->count(),
            'price'     => $this->total(),
            'isNew'     =>    $isNew,                
        ]);
    }
    
    public function update($rowId, $qty)
    {
        $cartItem = $this->get($rowId);
        $cartItem->qty = $qty;
        $content = $this->getCartContent();

        if ($rowId !== $cartItem->rowId) {
            $content->pull($rowId);
            if ($content->has($cartItem->rowId)) {
                $existingCartItem = $this->get($cartItem->rowId);
                $cartItem->setQuantity($existingCartItem->qty + $cartItem->qty);
            }
        }
        if ($cartItem->qty <= 0) {
            $this->remove($cartItem->rowId);
            return;
        } else {
            $content->put($cartItem->rowId, $cartItem);
        }
        $this->session->set($this->instance, $content);
        return $cartItem;
    }

    public function remove($id)
    {
        $cartItem = $this->get($this->getRowId($id));
        $content = $this->getCartContent();
        $content->pull($cartItem->rowId);
        $this->session->set($this->instance, $content);

        return json_encode([
            'price'=> $this->total(),
            'count'=> $this->count(),
        ]);
    }

    public function get($rowId)
    {
        $content = $this->getCartContent();
        if (!$content->has($rowId)) {
            throw new RowIDNotFoundException(
                "The cart does not contain rowId {$rowId}."
            );
        }
        return $content->get($rowId);
    }


    public function getRowId($id, array $options =[]) {
        ksort($options);
        return md5($id . serialize($options));
    }


    public function total($decimals = null,$decimalPoint = null,$thousandSeperator = null) 
    {
        $content = $this->getCartContent();

        $total = $content->reduce(function ($total, CartItem $cartItem) {
            return $total + ($cartItem->qty * $cartItem->priceTax);
        }, 0);

        return $this->numberFormat(
            $total,
            $decimals,
            $decimalPoint,
            $thousandSeperator
        );
    }

    public function subtotal($decimals = null,$decimalPoint = null,$thousandSeperator = null) 
    {
        $content = $this->getCartContent();

        $subTotal = $content->reduce(function ($subTotal, CartItem $cartItem) {
            return $subTotal + ($cartItem->qty * $cartItem->price);
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

        $count = $content->reduce(function ($count, CartItem $cartItem) {
            return $count + $cartItem->qty;
        }, 0);

        return $count;
    }

    public function count()
    {
        $content = $this->getCartContent();

        return $content->count();
    }

    private function isMulti($item)
    {
        return is_array($item);
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
