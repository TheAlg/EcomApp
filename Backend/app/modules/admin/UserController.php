<?php
declare(strict_types=1);

namespace App\Api\Controllers;

use Base\App\ControllerBase;
use App\Application\Models\ResetPasswords;
use App\Application\Models\EmailConfirmations;
use App\Application\Models\PasswordChanges;
use App\Application\Models\Users;
use App\Plugins\Auth\Exception as AuthException;
use Phalcon\Messages\Messages;

/**
 * Controller used handle non-authenticated session actions like login/logout,
 * user signup, and forgotten passwords
 */
class UserController extends ControllerBase
{
    public function initialize(){
        $this->responseType = [
            "complete"  => false,
            "message" => []
        ];
    }

    public function updateUserAction()
    {
       
        $data = $this->forms->getPost(['firstName','lastName', 'birthday', 'phoneNumber']);

        //check form inputs
        if (!$data)
            return $this->responseType['complete'] 
                = $this->forms->getMessages();

        //check if user is logged in
        if (!$this->auth->hasSession())
            return $this->responseType['complete'] 
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
        
        return $this->getResponseType();

    }

    public function getMessagess(Messages $messages) : array
    {
        $errors =[];
        foreach($messages as $message){
            array_push($errors, $message->getMessage());
        }
        return $errors;
    }

    public function getResponseType() : array
    {

        return $this->responseType;
    }
}
