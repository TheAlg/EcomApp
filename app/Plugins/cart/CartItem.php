<?php

namespace Base\Plugins;

use InvalidArgumentException;

class CartItem
{

    public $rowId;
    public $productId;
    public $title;
    public $picture;
    public $price;
    public $qty;
    public $options;
    private $associatedModel = null;
    private $taxRate = 0;

    public function __construct($productId, $title, $picture, $price, $qty, array $options = [])
        {
            $this->productId          = $productId;
            $this->title              = $title;
            $this->picture            = $picture;
            $this->price              = floatval($price);
            $this->qty                = $qty;

            $this->options  = $options;
            $this->rowId = $this->generateRowId($productId, $options);
        }
    public function setItem(Products $product){

    }

    public function price( $decimals = null, $decimalPoint = null, $thousandSeperator = null) 
        {
            return $this->numberFormat(
                $this->price,
                $decimals,
                $decimalPoint,
                $thousandSeperator
            );
        }

    public function priceTax($decimals = null, $decimalPoint = null, $thousandSeperator = null) 
        {
            return $this->numberFormat(
                $this->priceTax,
                $decimals,
                $decimalPoint,
                $thousandSeperator
            );
        }

    public function subtotal($decimals = null, $decimalPoint = null, $thousandSeperator = null) 
        {
            return $this->numberFormat(
                $this->subtotal,
                $decimals,
                $decimalPoint,
                $thousandSeperator
            );
        }


    public function total($decimals = null, $decimalPoint = null, $thousandSeperator = null) 
        {
            return $this->numberFormat(
                $this->total,
                $decimals,
                $decimalPoint,
                $thousandSeperator
            );
        }

    public function tax($decimals = null, $decimalPoint = null, $thousandSeperator = null) 
        {
            return $this->numberFormat(
                $this->tax,
                $decimals,
                $decimalPoint,
                $thousandSeperator
            );
        }

    public function taxTotal($decimals = null, $decimalPoint = null, $thousandSeperator = null) 
        {
            return $this->numberFormat(
                $this->taxTotal,
                $decimals,
                $decimalPoint,
                $thousandSeperator
            );
        }

    public function setTaxRate($taxRate)
        {
            $this->taxRate = $taxRate;

            return $this;
        }

    public function __get($attribute)
    {
        if (property_exists($this, $attribute)) {
            return $this->{$attribute};
        }

        if ($attribute === 'priceTax') {
            return $this->price + $this->tax;
        }

        if ($attribute === 'subtotal') {
            return $this->qty * $this->price;
        }

        if ($attribute === 'total') {
            return $this->qty * ($this->priceTax);
        }
        if ($attribute === 'tax') {
            return $this->price * ($this->taxRate / 100);
        }

        if ($attribute === 'taxTotal') {
            return $this->tax * $this->qty;
        }

        return null;
    }

    protected function generateRowId($id, array $options)
        {
            ksort($options);
            return md5($id . serialize($options));
        }

    public function setQuantity($qty)
        {
            if (empty($qty) || ! is_numeric($qty)) {
                throw new InvalidArgumentException('Please supply a valid quantity.');
            }
            $this->qty = $qty;
        }

    private function numberFormat($value, $decimals = null, $decimalPoint = null, $thousandSeperator = null) 
        {
            return number_format($value, $decimals, $decimalPoint, $thousandSeperator);
        }
}
