<?php 

namespace Base\Plugins;

//service injector 
use Phalcon\Di\Injectable;
//filter
use Phalcon\Filter\FilterFactory;
//validators
use Phalcon\Filter\Validation;
use Phalcon\Filter\Validation\Validator\Email;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Messages\Messages;
use Phalcon\Messages\Message;
use Phalcon\Filter\Validation\Validator\Uniqueness as UniquenessValidator;
use App\Application\Models\Users;


class DataContainer extends Injectable
{
    protected $sanitizer;
    protected $validator;
    public $formData;
    protected $isValid = false;
    public $errors;

    public function  __construct(){

        $this->sanitizer = (new FilterFactory())->newInstance(); //filter factory
        $this->validator = new Validation(); //data validator
        $this->errors = new Message('Post data is empty', 'getPost'); //if post was empty
  
        $this->formData = $this->request->getContentType() === 'application/x-www-form-urlencoded' ?
         $this->request->getJsonRawBody():
         $this->request->getPost(); //il manque un traitement pour cette demoiselle

        if (!empty($this->formData)){
            $this->sanitize();
            $this->setValidators();
            $this->isValid = count($this->validator->validate($this->formData)) ? false : true;
            $this->errors = $this->validator->validate($this->formData);
        }
    }


    public function getPost()
    {
        //return $this->filter->email('email');
        return $this->formData;
    }


    public function isValid() : bool
    {
        return $this->isValid && isset($this->formData);
    }

    public function getErrors() : \stdClass
    {
        return $this->handleError($this->errors);
    }

    public function sanitize() : void
    {
        foreach ($this->formData as $key => $value)
            switch ($key){
                case "email":
                    $this->formData->$key = $this->sanitizer->sanitize($value, "email");
                case 'id':
                    $this->formData->$key = $this->sanitizer->sanitize($value, 'int');
                default:
                    $this->formData->$key = $this->sanitizer->sanitize($value, 'string');
            }
        
    }

    public function setValidators() : void
    {
        if (property_exists($this->formData, "firstName"))
            $this->validator->add(
                'firstName', new PresenceOf(
                    [
                        'message' => 'Firstname is required',
                    ]
            ));
        if (property_exists($this->formData, "lastName"))
            $this->validator->add(
                'lastName', new PresenceOf(
                    [
                        'message' => 'Lastname is required',
                    ]
            ));
        if (property_exists($this->formData, "email")){
            $this->validator->add(
                'email', new PresenceOf(
                    [
                        'message' => 'Email is required',
                    ]
            ));
            $this->validator->add(
                'email',
                new Email(
                    [
                        'message' => 'Email is not valid',
                    ]
                )
            );
            if ($this->dispatcher->getActionName() === 'addUser')
            $this->validator->add(
                "email",
                new UniquenessValidator(
                    [
                        "model"     => new Users(),
                        "message" => "This email has already been registered",
                    ]
                )
            );
        }    
        if (property_exists($this->formData, "password"))
        $this->validator->add(
            'password',
            new PresenceOf(
                [
                    'message' => 'Password is required',
                ]
            )
        );    
    }


    public function handleError(Messages | Message $messages) : \stdClass
    {
        $errorMessages = new \stdClass;

        if (get_class($messages) === 'Phalcon\Messages\Message'){
            $field = $messages->getField();
            $errorMessages->$field = $messages->getMessage();
        }
        else
            foreach ($messages as $message){
                $field = $message->getField();
                $errorMessages->$field = $message->getMessage();
            }
        return $errorMessages;
    }
  
}	
