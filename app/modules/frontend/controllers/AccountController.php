<?php
declare(strict_types=1);

namespace App\Frontend\Controllers;
use Base\App\ControllerBase;
use App\Application\Models\address;
use App\Application\Models\creditCard;
use App\Forms\EditUsersForm;
use App\Forms\ChangeEmailForm;
use App\Forms\ChangePasswordForm;
use App\Forms\creditCardForm;
use App\Forms\DeliveryForm;




class AccountController extends ControllerBase
{

    public function initialize()
    {


        $this->user = $this->auth->getUser();

        $addresses = address::find([
            'userId = '=> $this->user->id,
        ]);
        if (count($addresses) > 0)
            $this->view->addresses = $addresses;

        $creaditCards = creditCard::getUserCards($this->user->id);
        if (count($creaditCards) > 0)
            $this->view->creaditCards = $creaditCards;


        $this->assets->collection('footerjs')->addJs('assets/js/app/account.js', true);  
        $this->EditUserForm = new EditUsersForm;
        $this->ChangeEmailForm = new ChangeEmailForm;
        $this->ChangePasswordForm = new ChangePasswordForm;
        $this->creditCardForm = new creditCardForm;
        $this->DeliveryForm = new DeliveryForm;

        $this->view->EditUserForm = $this->EditUserForm;
        $this->view->ChangeEmailForm = $this->ChangeEmailForm;
        $this->view->ChangePasswordForm = $this->ChangePasswordForm;
        $this->view->creditCardForm = $this->creditCardForm;
        $this->view->DeliveryForm = $this->DeliveryForm;

    }
    public function indexAction()
    {

    }

    public function editUserAction(){
        if ($this->request->isPost() 
        && $this->auth->isConnected()
        && $this->EditUserForm->isValid($this->request->getPost())) 
            return true;
        else
            foreach ($this->EditUserForm->getMessages() as $message) 
            $this->flash->error((string) $message);
    }


    public function editEmailAction(){
        if ($this->request->isPost()
        && $this->auth->isConnected()        
        && $this->ChangeEmailForm->isValid($this->request->getPost())){
           return true;
        }
        else
            foreach ($this->ChangeEmailForm->getMessages() as $message) 
            $this->flash->error((string) $message);
    }

    public function changePasswordAction(){
        if ($this->request->isPost()
        && $this->auth->isConnected()
        && $this->ChangePasswordForm->isValid($this->request->getPost())){
           return true;
        }
        else
            foreach ($this->ChangeEmailForm->getMessages() as $message) 
            $this->flash->error((string) $message);
    }

    public function editAddressAction(){
        if ($this->request->isPost()
        && $this->auth->isConnected()
        && $this->DeliveryForm->isValid($this->request->getPost())){
           return true;
        }
        else
            foreach ($this->DeliveryForm->getMessages() as $message) 
            $this->flash->error((string) $message);
 
    }

    public function addNewAddressAction(){
        if ($this->request->isAjax())
            $this->view->disable();

        if ($this->request->isPost()
        && $this->auth->isConnected()
        && $this->DeliveryForm->isValid($this->request->getPost())
        )
        {
            return true;
        }else {
            $this->response
                ->setContent(json_encode($this->DeliveryForm->getMessages()))
                ->send();
        }
    }

    public function deleteAddressAction(){
        if ($this->request->isPost() && $this->auth->getSession())
           return true;
        }

    public function addCreditCardAction(){
        if ($this->request->isPost()
        && $this->auth->getSession()
        && $this->creditCardForm->isValid($this->request->getPost())){
            return true;
        }
        else
            foreach ($this->creditCardForm->getMessages() as $message) 
            $this->flash->error((string) $message);
    }
    
    public function deleteCreditCardAction(){
        if ($this->request->isPost() && $this->auth->getSession())
            return true;    
    }
    public function addressDefaultAction(){
        if ($this->request->isPost() && $this->auth->getSession())
        return true;    
    }
    public function cardDefaultAction(){
        if ($this->request->isPost() && $this->auth->getSession())
        return true;    
    }
}