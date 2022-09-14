<?php
declare(strict_types=1);

namespace App\Backend\Controllers;
use Base\App\ControllerBase;
use App\Application\Models\Users;
use App\Application\Models\PasswordChanges;
use App\Application\Models\address;
use App\Application\Models\creditCard;
use App\Forms\EditUsersForm;
use App\Forms\ChangeEmailForm;


class AccountController extends ControllerBase
{
    public function initialize(){
        $this->user = $this->auth->getUser();
        $this->view->disable();
    }

    public function indexAction()
    {   
    }
    public function editUserAction()
    {
        if (!empty($this->request->getPost('name')))
            $this->user->name = $this->request->getPost('name', 'striptags');
        if (!empty($this->request->getPost('lastName')))
            $this->user->lastName = $this->request->getPost('lastName', 'striptags');
        if (!empty($this->request->getPost('birthday')))
            $this->user->birthdate = $this->request->getPost('birthday','date');
        if (!empty($this->request->getPost('phoneNumber')))
            $this->user->phoneNumber = $this->request->getPost('phoneNumber', 'int');

        if (!$this->user->save()) {
            foreach ($this->user->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
        } else {
            $this->flash->success('You have successfully updated your account !');
        }        
    }
    public function editEmailAction()
    {
        if ($this->request->getPost('currentEmail') === $this->user->email){
            $this->user->email = $this->request->getPost('newEmail', 'email');
            if (!$this->user->save()) 
                foreach ($this->user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            else 
                $this->flash->success('You have successfully updated your account !');
        } 
        else 
            $this->flash->error('The current email you have submitted is incorrect !');           
    }
    public function changePasswordAction()
    {
        if ($this->security->checkHash($this->request->getPost('currentPassword'), $this->user->password)){
            $this->user->password           = $this->security->hash($this->request->getPost('newPassword'));
            $this->user->mustChangePassword = 'N';
            //registering password changes
            $passwordChange            = new PasswordChanges();
            $passwordChange->usersId   = $this->user->id;
            $passwordChange->ipAddress = $this->request->getClientAddress();
            $passwordChange->userAgent = $this->request->getUserAgent();
    
            if (!$passwordChange->save() || !$this->user->save()) 
                foreach ($passwordChange->getMessages() as $message) 
                    $this->flash->error((string) $message);
            else 
                $this->flash->success('Your password was successfully changed');
        }
        else 
            $this->flash->error('The current password is incorrect');
         
    }
    public function editAddressAction(){
        $addressId = $this->request->getPost('addressId', 'int');
        $address = address::findFirst([
            "id = ".$addressId,
            "userId = ".$this->user->id]);

        if (!$address){
            $this->flash->error('En error has been occured');
            return $this->dispatcher->forward([
                'action' => 'index']);
        }
        if (!empty($this->request->getPost('title')))
            $address->addressName = $this->request->getPost('title');

        if (!empty($this->request->getPost('deliveryName')))
            $address->name = $this->request->getPost('deliveryName', 'striptags');

        if (!empty($this->request->getPost('deliveryLastName')))
            $address->lastName = $this->request->getPost('deliveryLastName', 'striptags');

        if (!empty($this->request->getPost('street')))
            $address->street = $this->request->getPost('street');

        if (!empty($this->request->getPost('complementary')))
            $address->addressComplement = $this->request->getPost('complementary', 'striptags');

        if (!empty($this->request->getPost('cityName')))
            $address->city = $this->request->getPost('cityName', 'striptags');

        if (!empty($this->request->getPost('postCode')))
            $address->postCode = $this->request->getPost('postCode', 'int');

        if (!$address->save()) 
            foreach ($address->getMessages() as $message) 
                $this->flash->error((string) $message);
            else 
                $this->flash->success('Your address has been successfully changed');
    
    }
    public function addNewAddressAction(){
        $reponse = 'false';
        $adress = new address;

        $adress->assign([
            'userId'            => $this->user->id,
            'addressName'       => $this->request->getPost('addressName', 'striptags'),
            'name'              => $this->request->getPost('name', 'striptags'),
            'lastName'          => $this->request->getPost('lastName', 'striptags'),
            'street'            => $this->request->getPost('street', 'striptags'),
            'addressComplement' => $this->request->getPost('addressComplement', 'striptags'),
            'postCode'          => $this->request->getPost('postCode', 'int'),
            'city'              => $this->request->getPost('city', 'striptags'),
        ]);
        if (!$adress->save()){
            foreach ($adress->getMessages() as $message) 
            $this->flash->error((string) $message);
        } else {
            $this->flash->success('You have successfully added a new address');
            $reponse = 'true';
        }
        $this->response->setContent($reponse);
        $this->response->send();
    }
    public function deleteAddressAction(){
        $addressId = $this->request->getPost('addressId', 'int');
        $address = address::findFirst([
            "id = ".$addressId,
            "userId = ".$this->user->id]);
        if (!$address){
            $this->flash->error('En error has been occured');
            return $this->dispatcher->forward([
                'module' => 'frontend',
                'controller' => $this->dispatcher->getControllerName(),
                'action' => 'index']);
        }
        if (!$address->delete()) 
            foreach ($address->getMessages() as $message) 
                $this->flash->error((string) $message);
        else 
            $this->flash->success('Your address was successfully deleted.');
    }
    public function addCreditCardAction(){
        //new card
        $creditCard = new creditCard;
        $creditCard->assign([
            'userId'        => $this->user->id,
            'number'    => $this->request->getPost('cardNumber', 'int'),
            'expiryDate'    => $this->request->getPost('expiryDate').'-01',
            'name'      => $this->request->getPost('cardName', 'striptags'),
        ]);
        //check other credit cards
        $creditCards = creditCard::getUserCards($this->user->id);
        //verify that credit card has a unique card number 
            for ($i =0; $i<count($creditCards); $i++)
                if ((string)$creditCards[$i]->number === (string)$creditCard->number )
                    return $this->flash->error('This card has already been registred ! ');

        if (!$creditCard->save()){
            foreach ($creditCard->getMessages() as $message) 
            $this->flash->error((string) $message);
        }
        else 
            $this->flash->success('You have successfully added a new credit card');
        
    }
    public function deleteCreditCardAction(){
        $creditCardId = $this->request->getPost('cardNumber', 'int');
        $creditCard = creditCard::findFirst([
            "number"=>$creditCardId,
            "userId"=>$this->user->id]);
        if (!$creditCard){
            $this->flash->error('En error has been occured');
            return $this->dispatcher->forward([
                'module' => 'frontend',
                'controller' => $this->dispatcher->getControllerName(),
                'action' => 'index',
                ]);
        }
        if (!$creditCard->delete()) 
            foreach ($creditCard->getMessages() as $message) 
                $this->flash->error((string) $message);
        else 
            $this->flash->success('Your credit card has been successfully deleted.');   
    }
    public function cardDefaultAction(){  
        $cardId = $this->request->getPost('card_id', 'int');

        $creditCard = creditCard::findFirstById($cardId);

        if ($creditCard) 
        {
            $creditCards = creditCard::find(['userId' =>$this->user->id]);
            //check if other cards has default to true
            for ($i =0; $i<count($creditCards); $i++)
                if ($creditCards[$i]->default === 'T'){
                    // and set it to false
                    $creditCards[$i]->default = 'F';
                    $creditCards[$i]->save();
                }
            //setting new default card
            $creditCard->default = 'T';
            $creditCard->save();
        }
    }
    public function addressDefaultAction(){
        $addressId = $this->request->getPost('address_id', 'int');

        $address = address::findFirstById($addressId);

        if ($address)
        {
            $addresses = address::find(['userId' =>$this->user->id]);
            //check if other addresses has default to true
            for ($i =0; $i<count($addresses); $i++)
                if ($addresses[$i]->default === 'T'){
                    // and set it to false
                    $addresses[$i]->default = 'F';
                    $addresses[$i]->save();
                }
            //setting new default card
            $address->default = 'T';
            $address->save();
        }
    }

    
}