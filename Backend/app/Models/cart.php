<?php
namespace App\Application\Models;
class cart extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $productId;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $picture;

    /**
     *
     * @var integer
     */
    public $qty;

    /**
     *
     * @var integer
     */
    public $price;

    /**
     * Initialize method for model.
     */


    /*public function initialize()
    {
        $this->setSchema("ecommerceproj");
        $this->setSource("cart");
    }*/

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cart[]|Cart|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cart|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }


    /**
     * Get the value of qty
     *
     * @return  integer
     */ 
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set the value of qty
     *
     * @param  integer  $qty
     *
     * @return  self
     */ 
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get the value of productId
     *
     * @return  string
     */ 
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @param  string  $productId
     *
     * @return  self
     */ 
    public function setProductId(string $productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of picture
     *
     * @return  string
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param  string  $picture
     *
     * @return  self
     */ 
    public function setPicture(string $picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of qty
     *
     * @return  integer
     */ 


    /**
     * Set the value of qty
     *
     * @param  integer  $qty
     *
     * @return  self
     */ 


    /**
     * Set the value of price
     *
     * @param  integer  $price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}
