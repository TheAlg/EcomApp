<?php
declare(strict_types=1);

namespace App\Api\Controllers;

use Base\App\ControllerBase;
use App\Application\Models\ResetPasswords;
use App\Application\Models\EmailConfirmations;
use App\Application\Models\PasswordChanges;
use App\Application\Models\Users;
use App\Plugins\Auth\Exception as AuthException;
use App\Forms\SignUpForm;
use Phalcon\Messages\Messages;

/**
 * Controller used handle non-authenticated session actions like login/logout,
 * user signup, and forgotten passwords
 */
class AuthController extends ControllerBase
{
    public function initialize(){
        $this->resetResponseType();
    }

    private $responseType = [
        "User" => false,
        "requestExists" => false,
        "sessionOn"  => false,
        "complete"  => false,
        "mustChangePassword" => false,
        "message" => []

    ];

    //generating a security
    public function securityTokenAction(){
        return $this->security->getTokenKey();
    }

    public function confirmEmailAction()
    {
        $data = $this->getPost();
        //check if a confirmation request exists
        $confirmation = EmailConfirmations::findFirstByCode($data->code);

        if ($confirmation && $confirmation->confirmed === 'N') {
            $this->responseType["requestExists"] = true;

            $user = Users::findFirst($confirmation->user->id);
            if ($user){
                $user->active = 'Y';
                $user->save();

                $confirmation->confirmed = 'Y';
                if ($confirmation->save()){
                    $this->responseType["complete"] = true;
                    $this->responseType["user"] =  $this->auth->getSession();
                }

                if ($this->auth->authUserById($confirmation->user->id))
                    $this->responseType["sessionOn"] = true;

                if ($confirmation->user->mustChangePassword == 'Y') {
                    //if a user have been invited by a another user, this action follows
                    //=> forward to a change password action
                    $this->responseType["message"] = "your have been invited by an x person, would you like to continue ";
                    $this->responseType["mustChangePassword"] = true;
                }
            }
            else $this->responseType["message"] = "user not found";

        }

        return $this->getResponseType();

    }
    //sends to request to change the passwords
    public function resetPasswordAction() 
    {
        $data = $this->getPost();

        $resetPassword = ResetPasswords::findFirstByCode($data->code);
        if ($resetPassword && $resetPassword->reset == 'N') {
            $this->responseType["requestExists"] = true;

            //$resetPassword->reset = 'Y';
            if ($resetPassword->save())
                $this->responseType["complete"] = true;
            else  
                $this->responseType["message"] = "password couldn't be saved";

            if ($this->auth->authUserById($resetPassword->user->id))
                $this->responseType["sessionOn"] = true;
        }
        else $this->responseType["message"] = "request not found ";


        return $this->getResponseType();
    }

    //session is the key, wether a user changed his password from an email
    // or from account settings the session should always be activated
    public function changePasswordAction()
    {  
        //needs a bit work
        $session =  $this->auth->getSession();
        if ($session){
            $this->responseType['requestExists'] = true;

            $user = Users::findFirstById($session['id']);

            if ($user){
                $newPassword = $this->security->hash($this->getPost()->password);
    
                //registering the password
                $user->password           = $newPassword;
                $user->mustChangePassword = 'N';
                if ($user->save()){
                    $this->responseType['complete'] = true;
                }
                //registering the change
                $passwordChange            = new PasswordChanges();
                $passwordChange->user      = $user;
                $passwordChange->ipAddress = $this->request->getClientAddress();
                $passwordChange->userAgent = $this->request->getUserAgent();
                $passwordChange->save();
        
                if ($this->auth->authUserById($user->id)){
                    $this->responseType["sessionOn"] = true;
                    $this->responseType["user"] =  $this->auth->getSession();
                }
                
            }
            else $this->responseType["message"] = "User not found";
        }
        else $this->responseType["message"] = "User not authorized";


        return $this->getResponseType();
    }
        


    public function resetResponseType()
    {
        $this->responseType =[
            "requestExists" => false,
            "sessionOn"  => false,
            "complete"  => false,
            "message" => [],
            "mustChangePassword" => false,

        ];
    }
    public function getResponseType() : array
    {
        return $this->responseType;
    }
}
