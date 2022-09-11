<?php
declare(strict_types=1);

namespace App\Forms;

use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;

use Phalcon\Filter\Validation\Validator\Confirmation;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Filter\Validation\Validator\StringLength;
use Phalcon\Filter\Validation\Validator\Email;

use App\Application\Models\Users;

class ChangeEmailForm extends Form
{
    public function initialize()
    
    {
        $userModel = new Users;
        $session = $this->getDI()->get('session')->get('auth-identity');
        $user = $userModel::findFirstById($session['id']);

        // Password
        $currentEmail = new Text('currentEmail', ['disabled' => true, 'value' => $this->mask_email($user->email)]);
        $currentEmail->setLabel('Current Email');
        $currentEmail->addValidators([
            new PresenceOf([
                'message' => 'Current Email is required',
            ]),
            new Email([
                'message' => 'Current Email is not valid',
            ]),
        ]);

        $newEmail = new Text('newEmail', ['disabled' => true]);
        $newEmail->setLabel('New Email');
        $newEmail->addValidators([
            new PresenceOf([
                'message' => 'New Email is required',
            ]),
            new Email([
                'message' => 'New Email is not valid',
            ]),
        ]);


        $this->add($currentEmail);
        $this->add($newEmail);

    }

    function mask_email($email, $masks = 5) {
        $array = explode("@", $email);
        $string_length = strlen($array[0]);
        if ($string_length < $masks)
            $masks = $string_length;
        $result = substr($array[0], 0, -$masks) . str_repeat('*', $masks);
        return $result."@".$array[1];
    }        
    
}