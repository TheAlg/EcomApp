<?php

namespace Base\Plugins;

use InvalidArgumentException;

class Item
{

    private $rowId;
    public $id;
    public $title;
    public $picture;
    public $price;
    public $qty;
    private $options;
    private $associatedModel = null;
    private $taxRate = 20/100;
    private $taxTotal;
    private $tax;

    public function __construct($item, $qty =1, array $options = [])
        {
            $this->id                = $item->id;
            $this->rowId             = $this->generateRowId($this->id, $options);

            $this->title              = $item->title;
            $this->picture            = $item->picture;
            $this->price              = $this->numberFormat($item->price, 2);
            $this->qty                = $qty;
            $this->isNew              = true;
            $this->options            = $options;

            $this->tax                = $item->price * $this->taxRate;
            $this->taxTotal           = $this->tax * $this->qty;
            $this->priceHT            = $this->numberFormat($item->price - $this->tax, 2);

            $this->total                = $this->numberFormat($qty * $item->price, 2);
        }
    public function __get($attribute)
    {
        if (property_exists($this, $attribute)) 
            return $this->{$attribute};
    }

    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;

        return $this;
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
