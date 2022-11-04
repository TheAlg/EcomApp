<?php
declare(strict_types=1);

namespace App\Api\Controllers;

use Base\App\ControllerBase;
use App\Application\Models\ResetPasswords;
use App\Application\Models\Users;
use App\Application\Models\address;
use App\Application\Models\payment;

use App\Plugins\Auth\Exception as AuthException;
use App\Forms\SignUpForm;
use Phalcon\Messages\Messages;

/**
 * Controller used handle non-authenticated session actions like login/logout,
 * user signup, and forgotten passwords
 */
class UserController extends ControllerBase
{

    public $responseType; //the json response we send to frontend application

    public function initialize(){

        //reset the reponse content
        $this->responseType =[
            'complete'      => false,
            "message"  =>[],
        ];

        //the user must be logged so he can use this controller
        if (!$this->auth->hasSession()){
            $this->responseType['message']='user not logged in';
            return $this->getResponseType();
        }
      
        $user = Users::findFirstById($this->auth->getSession()['id']);
     
        if (!$user) {
            $this->responseType['message']= 'user not found';
            return $this->getResponseType();
        }

        $this->user = Users::findFirstById($this->auth->getSession()['id']);


    }

    public function updateAction(){
       
        $data = $this->forms->getPost(['firstName','lastName','isoCode', 'birthday', 'phoneNumber']);
        //check form inputs
        if (!$data)
            return $this->responseType['message'] 
                = $this->forms->getMessages();

        //check if user is logged in
        if (!$this->auth->hasSession())
            return $this->responseType['message'] 
                = 'user not logged in';

            
        //proceed
        $user = Users::findFirstById($this->auth->getSession()['id']);
            foreach($data as $propretyName => $propretyValue){
                $user->$propretyName = $propretyValue;
            };
            //if user not saved in database
            if (!$user->save())
                return $this->responseType['message'] 
                    = $this->getMessages($user->getMessages());
            else  {
                $this->auth->authUserById($user->id);
                $this->responseType['complete'] =true;
                $this->responseType['user'] = $this->auth->getSession();
            }
        return $this->getResponseType();

    }

    public function getSessionAction(){
        if (!$this->auth->hasSession())
            return false;

        return $this->auth->getSession();
    }

    public function getAddressAction()
    {
        $this->responseType['complete'] = true;
        $this->responseType['address'] = $this->user->address;
        return $this->getResponseType();
    }

    public function postAddressAction()
    {
        //model properties
        $data = $this->forms->getPost(['id', 'street', 'complement', 'postCode', 'city']);

        if (!$data) {
            $this->responseType['message']= $this->forms->getMessages();
            return $this->getResponseType();
        }
        
        $address = $data->id === 0 ?
            new address():
            address::findFirstById($data->id);
        foreach ($data as $propertyName => $porepertyValue){
            $address->$propertyName = $porepertyValue;
        }
        if (!$address->save()){
            $this->responseType['message']= $this->getMessages($address->getMessages());
            return $this->getResponseType();
        }

        $this->responseType['complete']= true;
        $this->responseType['address']= $this->user->address;
        return $this->getResponseType();
    }
    
    public function deleteAddressAction()
    {
        //reset the reponse content
        $id =  $this->dispatcher->getParam('id');

        //address should be found
        $address =  address::findFirstById($id);
        if (!$address){
            $this->responseType['message'] = 'address not found';
            return $this->getResponseType();
        }
        //checks if the address belong to the user
        if ($address->userId !== $this->user->id){
            $this->responseType['message'] = 'unauthorized';
            return $this->getResponseType();
        }
        if (!$address->delete()) {
            $this->responseType['message'] = $this->getMessages($address->getMessages());
            return $this->getResponseType();
        }
        //proceed
        $this->responseType['complete'] = true;
        return $this->getResponseType();

    }

    public function getPayementAction()
    {
        $this->responseType['complete'] = true;
        $this->responseType['payment'] = $this->user->payment;

        return $this->getResponseType();
    }

    public function postPayementAction()
    {
        $data = $this->forms->getPost(['id', 'name', 'number', 'expiry']);

        if (!$data) {
            $this->responseType['message']= $this->forms->getMessages();
            return $this->getResponseType();
        }
        
        $payment = $data->id === 0 ?
            new payment():
            payment::findFirstById($data->id);
        if (!$payment || $payment === null){
            $this->responseType['message']= 'payement with id ' . $data->id .' don’t exist';
            return $this->getResponseType();
        }
        foreach ($data as $propertyName => $porepertyValue){
            $payment->$propertyName = $porepertyValue;
        }
        if (!$payment->save()){
            $this->responseType['message']= $this->getMessages($payment->getMessages());
            return $this->getResponseType();
        }

        $this->responseType['complete']= true;
        $this->responseType['payment']= $this->user->payment;
        return $this->getResponseType();
    }

    public function deletePayement(){
        
    }

    public function getMessages(array | Messages $messages) : array
    {
        $errors =[];
        foreach($messages as $message){
            array_push($errors, $message->getMessage());
        }
        return $errors;
    }

    public function getResponseType() : array
    {

        if ($this->responseType['complete'] === true && $this->auth->hasSession()){
            $this->responseType["sessionOn"] = true;
            $this->responseType["user"] = $this->auth->getSession();

        }
        return $this->responseType;
    }

}
