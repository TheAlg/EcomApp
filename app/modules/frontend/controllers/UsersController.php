<?php

namespace App\Frontend\Controllers;

use Base\App\ControllerBase;
use Phalcon\Mvc\View;
use Phalcon\Assets\Inline\Js;
use App\Forms\LoginForm;
use App\Forms\SignUpForm;
use Base\Container\Application;
use App\Forms\ForgotPasswordForm;


class UsersController extends ControllerBase
{
    protected LoginForm $loginForm;
    protected SignUpForm $registerForm;

    public function initialize(){
        $this->loginForm = new loginForm();
        $this->registerForm = new SignUpForm();
        $this->view->singUpForm = $this->registerForm;
        $this->view->loginForm =$this->loginForm;
    }
    public function indexAction(): void
    {
    }
    public function loginAction(){
        //posting login data
        if ($this->request->isPost() && $this->loginForm->isValid($this->request->getPost())){
            return $this->dispatcher->forward([
                'module'     => 'backend',
                'controller' => 'users',
                'action'     => 'login',
            ]);
        }
        //connecting with remebr me 
        if (!$this->request->isPost() && $this->auth->hasRememberMe()){
            return $this->dispatcher->forward([
                'module'     => 'backend',
                'controller' => 'users',
                'action'     => 'loginWithRememberMe',
            ]);
        }
        //errors
        foreach ($this->loginForm->getMessages() as $message) {
            $this->direct->error((string) $message);
        }
    }
    public function signUpAction(){
        
        //valid form 
        if ($this->request->isPost() && $this->registerForm->isValid($this->request->getPost())) {
                // success
                return $this->dispatcher->forward([
                    'module'     => 'backend',
                    'controller' => 'users',
                    'action'     => 'signUp',
                ]);
            }
        //failed
        foreach ($this->registerForm->getMessages() as $message) {
            $this->direct->error((string) $message);
        }
    }
    public function forgotPasswordAction()
    {
        $form = new ForgotPasswordForm();
        if ($this->request->isPost() && $form->isValid($this->request->getPost())) {
            return $this->dispatcher->forward([
                'module'     => 'backend',
                'controller' => 'users',
                'action'     => 'forgotPassword',
            ]);
        }
        foreach ($form->getMessages() as $message) {
            $this->flash->error($message);
        }

    }
    public function error404Action()
    {
        $this->simpleView->partial("404");
    }

}
