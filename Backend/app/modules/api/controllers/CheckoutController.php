<?php
declare(strict_types=1);

namespace App\Api\Controllers;
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

    public function getContentAction()
    {
        return $this->checkout->getContent();
    }

    public function addAddressAction()
    {
        return $this->forms->getPost();
    }

    public function addPayementAction()
    {

    }

}