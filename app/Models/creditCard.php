<?php

namespace App\Application\Models;
use Phalcon\Mvc\Model\Query\Builder;


class creditCard extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->setSource('creditCards');
    }

    public static function getUserCards($userId){

        $builder = new Builder();
        return $builder 
            ->columns('id, userId, number, name, YEAR(expiryDate) as year,  MONTH(expiryDate) as month, default')
            ->addFrom(creditCard::class,"card")
            ->andWhere('card.userId = '. $userId)
            ->getQuery()->execute();
    }
    public static function getUserCardsByNumber($userId, $cardNumber){
        $builder = new Builder();
        return $builder 
            ->addFrom(creditCard::class,"card")
            ->andWhere('card.userId = '. $userId)
            ->andWhere('card.number = '. $cardNumber)
            ->getQuery()->getSingleResult();
    }

            /**
     * Before create the user assign a password
     */
    public function beforeValidation()
    {
        //check other credit cards
        $defaultCard = creditCard::find(
            [
                'conditions'  => 'userId = :userId: and default = :default:',
                'bind' => [
                    'userId' => $this->getDI()->get('auth')->getUser()->id,
                    'default' => 'T'
                ]
            ]);
        //setting default to true if user has only one card
        if ($defaultCard->count() === 0)
            $this->default= 'T'; //T for true
        else $this->default= 'F';
    }


    public function afterDelete()
    {
        //check other credit cards
        $defaultCard = address::find(
            [
                'conditions'  => 'userId = :userId: and default = :default:',
                'bind' => [
                    'userId' => $this->getDI()->get('auth')->getUser()->id,
                    'default' => 'T'
                ]
            ]);
        //setting default to true if user has only one card

        if ($defaultCard->count() === 0){
            $cards = creditCard::find([ 
                'conditions'  => 'userId = :userId:',
                'bind' => [
                    'userId' => $this->getDI()->get('auth')->getUser()->id,
                ]
            ]);
            if ($cards->count() >= 1){
                //define a new default after deleting last address
                $cards[0]->default ='T';
                $cards[0]->save();
            }
        }
    }

    public static function default($userId){
        
        $defaultCard = creditCard::findFirst([
            'conditions' => 'userId = :userId: and default = \'T\'',
            'columns'    => ['number', 'name', 'YEAR(expiryDate) as year',  'MONTH(expiryDate) as month'],
            'bind'       => [
                'userId' => $userId
            ]]);
        if (isset($defaultCard))
            return $defaultCard;
        else 
            return false;
    }

}