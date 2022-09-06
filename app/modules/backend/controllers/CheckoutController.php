<?php
declare(strict_types=1);

namespace App\Backend\Controllers;
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
        $this->view->disable();
    }

    public function indexAction()
    {
        $userId = $this->auth->getUser()->id;
        $checkout = [
            'isConnected' => $this->auth->isConnected(),
            'address'     => address::default($userId),
            'creditCard'  => creditCard::default($userId),
        ]; 
       return json_encode($checkout); 
    }
}