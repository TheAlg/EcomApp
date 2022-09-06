<?php
declare(strict_types=1);

namespace App\Forms;

use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Numeric;

use Phalcon\Forms\Form;
use Phalcon\Filter\Validation\Validator\Confirmation;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Filter\Validation\Validator\StringLength;

class ChangePasswordForm extends Form
{
    public function initialize()
    {
        // Password
        $currentPassword = new Password('currentPassword',['disabled'=>true]);
        $currentPassword->setLabel('Current Password');
        $currentPassword->addValidators([
            new PresenceOf([
                'message' => 'Password is required',
            ]),
        ]);
        $this->add($currentPassword);


        // Password
        $newPassword = new Password('newPassword',['disabled'=>true]);
        $newPassword->setLabel('New Password');
        $newPassword->addValidators([
            new PresenceOf([
                'message' => 'Password is required',
            ]),
            new StringLength([
                'min'            => 8,
                'messageMinimum' => 'Password is too short. Minimum 8 characters',
            ]),

        ]);

        $this->add($newPassword);

        // Confirm Password
        $confirmPassword = new Password('confirmPassword',['disabled'=>true]);
        $confirmPassword->setLabel('Confirm new Password');
        $confirmPassword->addValidators([
            new PresenceOf([
                'message' => 'The confirmation password is required',
            ]),
            new Confirmation([
                'message' => 'Password doesn\'t match confirmation',
                'with'    => 'newPassword',
            ]),
        ]);
        
        $this->add($confirmPassword);
    }
}
