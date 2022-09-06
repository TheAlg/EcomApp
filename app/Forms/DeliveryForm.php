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
use Phalcon\Filter\Validation\Validator\StringLength;


class DeliveryForm extends Form
{
    public function initialize($entity = null, array $options = [])
    {

        $addressId = new Hidden('addressId');
        $this->add($addressId);

        $title = new Text('addressName',['placeholder'=> 'example : home']);
        $title->setLabel('Title');
        $title->addValidators([
            new StringLength([
                'min'            => 3,
                'messageMinimum' => 'Your title must have at least 3 caracters',
            ])]
      );
        $this->add($title);

        $name = new Text('name');
        $name->setLabel('Name');
        $name->addValidators([
            new StringLength([
            'min'            => 3,
            'messageMinimum' => 'Your name must have at least 3 caracters',
        ])]);
        $this->add($name);

        $lastName = new Text('lastName');
        $lastName->setLabel('Last Name');
        $lastName->addValidators([
            new StringLength([
            'min'            => 3,
            'messageMinimum' => 'Your last name must have at least 3 caracters',
        ])]);
        $this->add($lastName);

        $Street = new Text('street');
        $Street->setLabel('Street name and number ');
        $this->add($Street);

        $complementary = new Text('addressComplement');
        $complementary->setLabel('Address complementary (optional)');
        $this->add($complementary);

        $postCode = new Numeric('postCode');
        $postCode->setLabel('Post Code');
        $this->add($postCode);

        $city = new Text('city');
        $city->setLabel('City');
        $city->addValidators([
            new StringLength([
            'min'            => 3,
            'messageMinimum' => 'Your city name must have at least 3 caracters',
        ])]);
        $this->add($city);

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