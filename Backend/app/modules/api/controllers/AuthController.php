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
class AuthController extends ControllerBase
{
    public function initialize(){
        $this->responseType = [
            "complete"  => false,
            "message" => []
        ];
    }
    public function signUpAction() 
    {
        $data = $this->forms->getPost(['email', 'password']);
       // return $data;
        //check if post data is valid
        if (!$data){
            $this->responseType['message']= $this->forms->getMessages();
            return $this->getResponseType();
        }

        //Create the user
        $user = new Users();
            $user->email = $data->email;
            $user->password = $data->password;
            $user->ProfilesId = 2; // role user
        
        //check if succesfully saved in database
        if(!$user->save()){
            $this->responseType['message']=$this->getMessages($user->getMessages());
            return $this->getResponseType();
        }

        //log the user in
        $this->auth->authUserById($user->id);
        //proceed
        $this->dispatcher->forward([
            'module'   => 'api',
            "controller" => 'User',
            "action"     => 'getUser'
        ]);
    }
    public function loginAction() //: array
    {
        $data = $this->forms->getPost(['email', 'password']);
        //check if post data is valid
        if (!$data){
            $this->responseType['message']=$this->forms->getMessages();
            return $this->getResponseType();
        }

        $isAuth = $this->auth->check([
            'email'    => $data->email,
            'password' => $data->password,
            //'remember' => $data->rememberMe,
        ]);

        //check if user is authorized
        if (!$isAuth){
            $this->responseType['message']= $this->auth->getMessages();
            return $this->getResponseType();
        }
               
        //proceed
        $this->dispatcher->forward([
            'module'   => 'api',
            "controller" => 'User',
            "action"     => 'getUser'
        ]);
    }
    public function logoutAction(){
        $this->auth->remove();
    }

    public function forgetPasswordAction() :array
    {
       if ($this->getDI()->get('config')->useMail) {
        
            $data = $this->forms->getPost(['email']);

            $user = Users::findFirstByEmail($data->email);
            if ($user) {
                $resetPassword          = new ResetPasswords();
                $resetPassword->usersId = $user->id;

                $resetPassword->save();
                
                $this->responseType["complete"] = true;
            }
       }
        return $this->getResponseType();
    } 

    public function confirmEmailAction()
    {
        $data = $this->forms->getPost();
        //check if a confirmation request exists
        $confirmation = EmailConfirmations::findFirstByCode($data->code);

        if ($confirmation && $confirmation->confirmed === 'N') {

            $user = Users::findFirst($confirmation->user->id);
            if ($user){
                $confirmation->confirmed = 'Y';
                if ($confirmation->save()){
                    $this->responseType["complete"] = true;
                    $this->responseType["user"] =  $this->auth->getSession();
                }
    
                if ($confirmation->user->mustChangePassword == 'Y') {
                    //if a user have been invited by a another user, this action follows
                    //=> forward to a change password action
                    $this->responseType["message"] = "your have been invited by an x person, would you like to continue ";
                    $this->responseType["mustChangePassword"] = true;
                }
            }

            else 
                return $this->responseType["message"] 
                    = "user not found";

        }

        return $this->getResponseType();

    }
    //sends to request to change the passwords
    public function resetPasswordAction() 
    {
        $data = $this->request->getPost();

        $resetPassword = ResetPasswords::findFirstByCode($data->code);
        if ($resetPassword && $resetPassword->reset == 'N') {

            $resetPassword->reset = 'Y';
            $resetPassword->save() ?
                $this->responseType["complete"] = true:
                $this->responseType["message"] = "password couldn't be saved";
        }
        else $this->responseType["message"] = "request not found ";

        return $this->getResponseType();
    }
    //session is the key, wether a user changed his password from an email
    // or from account settings the session should always be activated
    public function changePasswordAction()
    {  
        //needs a bit work
        if ($this->auth->hasSession()){
            $session =  $this->auth->getSession();
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
        
                /*if ($this->auth->authUserById($user->id)){
                    $this->responseType["sessionOn"] = true;
                    $this->responseType["user"] =  $this->auth->getSession();
                }*/
                
            }
            else $this->responseType["message"] = "User not found";
        }
        else $this->responseType["message"] = "User not authorized";


        return $this->getResponseType();
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

        return $this->responseType;
    }
}
