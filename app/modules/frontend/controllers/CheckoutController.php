<?php
declare(strict_types=1);

namespace App\Frontend\Controllers;
use Base\App\ControllerBase;
use App\Forms\EditUsersForm;
use App\Forms\ChangeEmailForm;
use App\Forms\ChangePasswordForm;
use App\Forms\creditCardForm;
use App\Forms\DeliveryForm;
use App\Application\Models\address;
use App\Application\Models\creditCard;


class CheckoutController extends ControllerBase
{
    public function initialize()
    {
        if ($this->auth->isConnected())
            return $this->response->redirect('/user/login/');

        $this->assets->collection('footerjs')->addJs('assets/js/app/checkout.js', true);  

        $this->view->controllerName = $this->dispatcher->getControllerName();

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
        if ($this->request->isPost())
            return true;
    }
}