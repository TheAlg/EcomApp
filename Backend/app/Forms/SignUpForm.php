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
    public function initialize($entity = null, array $options = [])
    {
        $name = new Text('register_name',
        [
            //"required" => true,
            "placeholder" => "Votre Nom"
        ]
        );
        $name->setLabel('Name');
        $name->addValidators([
            new PresenceOf([
                'message' => 'The name is required',
            ]),
        ]);

        $this->add($name);

        // Email
        $email = new Text('register_email',        [
            //"required" => true,
            "placeholder" => "Email Address"
        ]);
        $email->setLabel('E-Mail');
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
        $password = new Password('register_password', [
            //"required" => true,
            "placeholder" => "Password"
        ]);
        $password->setLabel('Password');
        $password->addValidators([
            new PresenceOf([
                'message' => 'The password is required',
            ]),
            new StringLength([
                'min'            => 8,
                'messageMinimum' => 'Password is too short. Minimum 8 characters',
            ]),
        ]);

        $this->add($password);

        // Confirm Password
        $confirmPassword = new Password('register_confirmPassword', [
            //"required" => true,
            "placeholder" => "Confirm Password"
        ]);
        $confirmPassword->setLabel('Confirm Password');
        $confirmPassword->addValidators([
            new PresenceOf([
                'message' => 'The confirmation password is required',
            ]),
            new Confirmation([
                'message' => "confirmation doesn't match password",
                'with'    => 'register_password',
            ]),
        ]);

        $this->add($confirmPassword);

        // Remember
        $terms = new Check('register_terms', [
            'value' => 'yes',
        ]);

        $terms->setLabel('Accept terms and conditions');
        $terms->addValidator(new Identical([
            'value'   => 'yes',
            'message' => 'Terms and conditions must be accepted',
        ]));

        $this->add($terms);

        // CSRF
        $csrf = new Hidden('register_token');
        $csrf->addValidator(new Identical([
            'value'   => $this->security->getRequestToken(),
            'message' => 'CSRF validation failed',
        ]));
        $csrf->clear();

        $this->add($csrf);

        // Sign Up
        $this->add(new Submit('Sign Up'));
    }

    /**
     * Prints messages for a specific element
     *
     */
    public function messages(string $name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                return $message;
            }
        }
        return '';
    }
}
