<?php

namespace App\Application\Models;
use Phalcon\Mvc\Model\Query\Builder;


class payment extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->userId = $this->getDI()->get('auth')->getSession()['id'];

        $this->setSource('payment');
        
        $this->belongsTo(
            'userId',
            Users::class,
            'id'
        );
    }
            /**
     * Before create the user assign a password
     */
    public function beforeValidation()
    {
        //check other credit cards
        $defaultCard = payment::find(
            [
                'conditions'  => 'userId = :userId: and default = :default:',
                'bind' => [
                    'userId' => $this->userId,
                    'default' => 'T'
                ]
            ]);
        //setting default to true if user has only one card
        if ($defaultCard->count() === 0)
            $this->default= 'T'; //T for true
        else $this->default= 'F';
    }
    public function beforeValidationOnUpdate()
    {
        $this->default= 'T'; //T for true
    }

    public function afterDelete()
    {
        //check other credit cards
        $defaultCard = address::find(
            [
                'conditions'  => 'userId = :userId: and default = :default:',
                'bind' => [
                    'userId' => $this->userId,
                    'default' => 'T'
                ]
            ]);
        //setting default to true if user has only one card

        if ($defaultCard->count() === 0){
            $cards = payment::find([ 
                'conditions'  => 'userId = :userId:',
                'bind' => [
                    'userId' => $this->userId,
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
        
        $defaultCard = payment::findFirst([
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