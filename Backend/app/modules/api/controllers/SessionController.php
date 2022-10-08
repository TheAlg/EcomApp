<?php
declare(strict_types=1);

namespace App\Api\Controllers;

use Base\App\ControllerBase;
use App\Application\Models\ResetPasswords;
use App\Application\Models\Users;
use App\Plugins\Auth\Exception as AuthException;
use App\Forms\SignUpForm;
use Phalcon\Messages\Messages;

/**
 * Controller used handle non-authenticated session actions like login/logout,
 * user signup, and forgotten passwords
 */
class SessionController extends ControllerBase
{
    private $responseType =[
        'sessionOn'    => false,
        'complete'      => false,
        "user"      => false,
        "message "  =>[],
    ];

    //reset the reponse content
    public function initialize(){
        $this->resetResponseType();
    }

    public function signUpAction() :array
    {

        $data = $this->getPost();
        $user = new Users([
            'firstName'  => $data->firstName,
            'lastName'   => $data->lastName,
            'email'      => $data->email,
            'password'   => $this->security->hash($data->password),
            'profilesId' => 2,
        ]);
        if ($user->save()){
            //we login the new user
            if ($this->auth->authUserById($user->id))
                $this->responseType["sessionOn"] = true;
            $this->responseType['complete'] =  true;
            $this->responseType['user'] = $this->auth->getSession();
        }
        else  
            $this->responseType['message'] = $this->handleError($user->getMessages());
        
        return $this->getResponseType();
    }
    public function loginAction() : array
    {
        $data = $this->getPost();
        $isAuth = $this->auth->check([
            'email'    => $data->email,
            'password' => $data->password,
            'remember' => $data->rememberMe,
        ]);
        if ($isAuth){
            $this->responseType['sessionOn'] =  true;
            $this->responseType['complete'] =  true;
            $this->responseType['user'] = $this->auth->getSession();
        }
        else  
            $this->responseType['message'] = $this->auth->getErrors();
        
        return $this->getResponseType();
    }

    public function forgetPasswordAction() :array
    {
       if ($this->getDI()->get('config')->useMail) {
        
            $data = $this->getPost();

            $user = Users::findFirstByEmail($data->email);

            if ($user) {
                $resetPassword          = new ResetPasswords();
                $resetPassword->usersId = $user->id;
                if($resetPassword->save())
                    $this->responseType["complete"] = true;
            }
       }
        return $this->getResponseType();
    } 

    public function getCurrentSessionAction(){
            return $this->auth->getSession();
    }

    public function logoutAction(){
        $this->auth->remove();
    }

    
    public function resetResponseType()
    {
            
        $this->responseType =[
            'sessionOn'    => false,
            'complete'      => false,
            "user"      => false,
            "message "  =>[],
        ];
    }

    public function getResponseType() : array
    {
        return $this->responseType;
    }

}
