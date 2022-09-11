<?php
declare(strict_types=1);

namespace App\Forms;

use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Date;
use App\Application\Models\Users;
use Phalcon\Forms\Form;
use Phalcon\Filter\Validation\Validator\Email;
use Phalcon\Filter\Validation\Validator\PresenceOf;

class EditUsersForm extends Form
{
    public function initialize($entity = null, array $options = [])
    {
        $userModel = new Users;
        //$userModel->refresh();
        $session = $this->getDI()->get('session')->get('auth-identity');
        $user = $userModel::findFirstById($session['id']);

        $name = new Text('name', ['disabled' => true, 'value' => $user->name]);
        $name->setLabel('Name');
        $this->add($name);

        $lastName = new Text('lastName', ['disabled' => true, 'value' => $user->lastName]);
        $lastName->setLabel('Last Name');
        $this->add($lastName);

        $birthDate = new Date('birthday', ['disabled' => true, 'value' => $user->birthdate]);
        $birthDate->setLabel('Birthday');
        $this->add($birthDate);

        $PhoneNumber = new Text('phoneNumber', ['disabled' => true,'value' => $user->phoneNumber]);
        $PhoneNumber->setLabel('Phone Number');

        $this->add($PhoneNumber);

    }
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
