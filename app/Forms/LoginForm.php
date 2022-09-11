<?php
declare(strict_types=1);


namespace App\Forms;

use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Filter\Validation\Validator\Email;
use Phalcon\Filter\Validation\Validator\Identical;
use Phalcon\Filter\Validation\Validator\PresenceOf;

class LoginForm extends Form
{
    public function initialize()
    {
        // Email
        $email = new Text('login_email', [
            'required'=> true,         
            'placeholder' => 'Email',
        ]);
        $email->setLabel('Votre E-mail');

        $email->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required',
            ]),
            new Email([
                'message' => 'The e-mail is not valid',
            ]),
        ]);

        $this->add($email);

        // Password
        $password = new Password('login_password', [
            'required'=> true,         
            'placeholder' => 'Password',
        ]);
        $password->setLabel('Votre mot de passe');
        $password->addValidator(new PresenceOf([
            'message' => 'The password is required',
        ]));
        $password->clear();

        $this->add($password);

        // Remember
        $remember = new Check('login_remember', [
            'value' => 'yes',
            'id'    => 'login-remember',
        ]);
        $remember->setLabel('Remember me');

        $this->add($remember);

        // CSRF
        $csrf = new Hidden('login_token');
        $csrf->addValidator(new Identical([
            'value'   => $this->security->getRequestToken(),
            'message' => 'CSRF validation failed',
        ]));
        $csrf->clear();

        $this->add($csrf);
        $this->add(new Submit('Login'));
    }
}
