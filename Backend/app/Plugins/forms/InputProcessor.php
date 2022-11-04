<?php 

namespace Base\Plugins;

use Phalcon\Di\Injectable;
use Phalcon\Filter\FilterFactory;
use Phalcon\Filter\Validation;
use Phalcon\Filter\Validation\Validator\Email;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Messages\Message;
use Phalcon\Filter\Validation\Validator\Uniqueness as UniquenessValidator;
use App\Application\Models\Users;
use Base\App\ControllerBase;



class InputProcessor extends Injectable
{

    public $output;
    public $messages=[];

    public function __construct(){
        $this->validator = new Validation(); 
    }


    public function getPost(array $arr)
    {        
        //input as raw data before validation 
        $input = $this->request->getJsonRawBody() !== null ?
            $this->request->getJsonRawBody():
            (object) $this->request->getPost();
        
        //check if post data not empty
        if (!(array)$input) {
            array_push($this->messages, new Message("post data is empty"));
            return false;
        }
        
        //we create a new object containing only data that we need 
        //the output contains sanitized and validated data
        $this->output = new \stdClass;
        // arr : list of model properties

        foreach($arr as $key){
             //sanitize and validate data;
            $value = isset($input->$key) ? $input->$key: '';
            $this->sanitize($key, $value);
        };
        return $this->output;
        $messages = $this->validator->validate($this->output);
        if (count($messages) > 0){
            $this->messages = $messages;
            return false;
        }


        return $this->output;
    }


    public function sanitize(string $key, string $value) 
    {
        $fn = 'check' . ucfirst($key);
            return $this->$fn($value);
    }

    public function checkId(string $id) : void
    {
        $this->validator->add(
            'id', new PresenceOf(
                [
                    'message' => 'id is required',
                ]
        ));
        $this->output->id = (int) $this->filter->sanitize($id, 'int');
    }

    public function checkBirthday(string $date) : void
    {
        $this->output->birthday = date('Y-m-d h:i:s', strtotime($date));
    }

    public function checkFirstName(string $firstName) : void
    {
        $this->output->firstName = $this->filter->sanitize($firstName, '');
    }

    public function checkLastName(string $lastName) :void
    {
        $this->output->lastName = $this->filter->sanitize($lastName, 'string');
    }
    
    public function checkUserName(string $userName) :void
    {
        $this->output->userName = $this->filter->sanitize($userName, 'string');
    }

    public function checkEmail(string $email) : void
    {
        $this->validator->add(
            'email', new PresenceOf(
                [
                    'message' => 'Email is required',
                ]
        ));
        $this->validator->add(
            'email', new email(
                [
                    'message' => 'Email is not valid',
                ]
        ));
        if ($this->dispatcher->getActionName() === 'signUp')
        $this->validator->add(
            "email",
            new UniquenessValidator(
                [
                    "model"     => new Users(),
                    "message" => "This email has already been registered",
                ]
            )
        );

        $this->output->email = $this->filter->sanitize($email, 'email');
    }

    public function checkPhoneNumber(string $value)
    {
        $this->output->phoneNumber = $value;
    }

    public function checkPassword(string $password){
        $this->validator->add(
            'password',
            new PresenceOf(
                [
                    'message' => 'Password is required',
                ]
            )
        );    
        if (!empty($password)){
            $this->output->password = $this->dispatcher->getActionName() === 'signUp' ?
            $this->security->hash($password): $password;
        }
    }
    public function checkIsoCode(string $isoCode)
    {
        $this->validator->add(
            'isoCode', new PresenceOf(
                [
                    'message' => 'country dial is required',
                ]
        ));
        $this->output->isoCode = $this->filter->sanitize($isoCode, 'string');
    }

    public function checkStreet(string $street)
    {
        $this->validator->add(
            'street', new PresenceOf(
                [
                    'message' => 'street number is required',
                ]
        ));
        $this->output->street = $this->filter->sanitize($street, 'string');
    }
    
    public function checkComplement(string $complement)
    {
        $this->output->complement = $this->filter->sanitize($complement, 'string');
    }
    public function checkPostCode(string $postCode)
    {      
        $this->validator->add(
        'postCode', new PresenceOf(
            [
                'message' => 'Post code is required',
            ]
    ));
        $this->output->postCode = $this->filter->sanitize($postCode, 'int');
    }
    public function checkCity(string $isoCode)
    {
        $this->validator->add(
            'city', new PresenceOf(
                [
                    'message' => 'City is required',
                ]
        ));
        $this->output->city = $this->filter->sanitize($isoCode, 'string');
    }

    public function checkExpiry(string $value ){
        $this->validator->add(
            'expiry', new PresenceOf(
                [
                    'message' => 'expiry date is required',
                ]
        ));
        $this->output->expiry = date('Y-m', strtotime($value));
    }
    public function checkNumber(string $value){
        $this->validator->add(
            'number', new PresenceOf(
                [
                    'message' => 'card number is required',
                ]
        ));
        $this->output->number = $this->filter->sanitize($value, 'int');
    }
    public function checkName(string $value){
        $this->validator->add(
            'name', new PresenceOf(
                [
                    'message' => 'card name is required',
                ]
        ));
        $this->output->name = $this->filter->sanitize($value, 'string');
    }

    public function getMessages()
    {
        $errors =[];
        foreach($this->messages as $message){
            array_push($errors, $message->getMessage());
        }
        return $errors;
    }

  
}	
