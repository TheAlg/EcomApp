<?php
declare(strict_types=1);

namespace Vokuro\Forms;

use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Form;
use Phalcon\Filter\Validation\Validator\Confirmation;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Filter\Validation\Validator\StringLength;

class ChangePasswordForm extends Form
{
    public function initialize()
    {
        // Password
        $password = new Password('password');
        $password->addValidators([
            new PresenceOf([
                'message' => 'Password is required',
            ]),
            new StringLength([
                'min'            => 8,
                'messageMinimum' => 'Password is too short. Minimum 8 characters',
            ]),
            new Confirmation([
                'message' => 'Password doesn\'t match confirmation',
                'with'    => 'confirmPassword',
            ]),
        ]);

        $this->add($password);

        // Confirm Password
        $confirmPassword = new Password('confirmPassword');
        $confirmPassword->addValidators([
            new PresenceOf([
                'message' => 'The confirmation password is required',
            ]),
        ]);

        $this->add($confirmPassword);
    }
}
