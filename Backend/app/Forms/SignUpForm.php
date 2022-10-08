<?php
declare(strict_types=1);

namespace App\Forms;

use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Filter\Validation\Validator\Confirmation;
use Phalcon\Filter\Validation\Validator\Email;
use Phalcon\Filter\Validation\Validator\Identical;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Filter\Validation\Validator\StringLength;

class SignUpForm extends Form
{
    /**
     * @param null $entity
     * @param array $options
     */
    public function initialize()
    {
        $firstName = new Text('firstName');
        $firstName->addValidators([
            new PresenceOf([
                'message' => 'First Name is required',
            ]),
        ]);

        $lastName = new Text('lastName');
        $lastName->addValidators([
            new PresenceOf([
                'message' => 'Last Name is required',
            ]),
        ]);
        
        $userName = new Text('userName');
        $userName->addValidators([
            new PresenceOf([
                'message' => 'Username is required',
            ]),
        ]);

        $email = new Text('email');
        $email->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required',
            ]),
            new Email([
                'message' => 'The e-mail is not valid',
            ]),
        ]);

        $password = new Password('password');
        $password->addValidators([
            new PresenceOf([
                'message' => 'The password is required',
            ]),
            new StringLength([
                'min'            => 5,
                'messageMinimum' => 'Password is too short. Minimum 5 characters',
            ]),
        ]);

        $this->add($firstName);
        $this->add($lastName);
        $this->add($email);
        $this->add($password);
    }

}
