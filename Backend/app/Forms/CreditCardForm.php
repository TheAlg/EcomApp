<?php
declare(strict_types=1);

namespace App\Forms;

use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Filter\Validation\Validator\CreditCard;
use Phalcon\Filter\Validation\Validator\Digit;
use App\Application\Models\Users;

class CreditCardForm extends Form
{
    public function initialize()
    
    {
        $cardId = new Hidden('cardId');
        $this->add($cardId);

        $cardNumber = new Text('cardNumber');
        $cardNumber->setLabel('Card Number');
        $cardNumber->addValidators([
            new PresenceOf([
                'message' => 'Credit Card is required',
            ]),
            new CreditCard([
                'message' => 'Credit Cart is not valid',
            ]),
        ]);

        $expiryDate = new Date('expiryDate', ['type' => 'month']);
        $expiryDate->setLabel('Expiry Date');
        $expiryDate->addValidators([
            new PresenceOf([
                'message' => 'Expiry date is required',
            ]),
        ]);

        $name = new Text('cardName');
        $name->setLabel('Name');
        $name->addValidators([
            new PresenceOf([
                'message' => 'Name is required',
            ]),
        ]);


        $this->add($cardNumber);
        $this->add($expiryDate);
        $this->add($name);

    }

}