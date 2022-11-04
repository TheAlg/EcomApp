<?php

namespace App\Application\Models;

class address extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->userId = $this->getDI()->get('auth')->getSession()['id'];
        $this->setSource('address');

        $this->belongsTo(
            'userId',
            Users::class,
            'id'
        );
    
    }


    public function beforeValidation()
    {
        //check other credit cards
        $defaultAddress = address::find(
            [
                'conditions'  => 'userId = :userId: and default = :default:',
                'bind' => [
                    'userId' => $this->userId,
                    'default' => 'T'
                ]
            ]);
        //setting default to true if user dont have any default address
        if ($defaultAddress->count() === 0)
            $this->default= 'T'; //T for true
        else $this->default= 'F';
    }
    public function beforeValidationOnUpdate()
    {
        //check other credit cards
        $defaultAddress = address::find(
            [
                'conditions'  => 'userId = :userId: and default = :default:',
                'bind' => [
                    'userId' => $this->userId,
                    'default' => 'T'
                ]
            ]);
        $this->default= 'T'; //T for true

    }


    public function afterDelete()
    {
        //check other credit cards
        $defaultAddress = address::find(
            [
                'conditions'  => 'userId = :userId: and default = :default:',
                'bind'        => 
                [
                    'userId'    => $this->userId,
                    'default'   => 'T'
                ]
            ]);
        //setting default to true if user has only one card

        if ($defaultAddress->count() === 0){
            $addresses = address::find([ 
                'conditions'  => 'userId = :userId:',
                'bind' => [
                    'userId' => $this->userId,
                ]
            ]);

            //define a new default after deleting last address
            if ($addresses->count() >= 1){
                $addresses[0]->default = 'T';
                $addresses[0]->save();
            }
        }
    }
    public static function default($userId){
        $defaultAddress = address::findFirst([
            'conditions' => 'userId = :userId: and default = \'T\'',
            'columns'    => ['addressName', 'city', 'name',  'lastName', 'postCode', 'street', 'addressComplement'],
            'bind'       => [
                'userId' => $userId
            ]]);
        return isset($defaultAddress)?
            $defaultAddress:
            false;
    }

    

}