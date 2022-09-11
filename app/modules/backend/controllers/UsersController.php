<?php
declare(strict_types=1);

namespace App\Backend\Controllers;

use Base\App\ControllerBase;
use App\Application\Models\ResetPasswords;
use App\Application\Models\Users;
use App\Plugins\Auth\Exception as AuthException;

/**
 * Controller used handle non-authenticated session actions like login/logout,
 * user signup, and forgotten passwords
 */
class UsersController extends ControllerBase
{
    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function initialize(): void
    {
        //$this->view->setTemplateBefore('public');
    }

    public function indexAction(): void
    {
    }

    /**
     * Allow a user to signup to the system
     */
    public function signUpAction()
    {
        $user = new Users([
            'name'       => $this->request->getPost('register_name', 'striptags'),
            'email'      => $this->request->getPost('register_email'),
            'password'   => $this->security->hash($this->request->getPost('register_password')),
            'profilesId' => 2,
        ]);

        if ($user->save()) {
            return $this->loginAction($this->request->getPost('register_email'), 
                                    $this->request->getPost('register_password'));
        }
        //not saved
        foreach ($user->getMessages() as $message) {
            $this->flash->error($message->getMessage());
        }
        return $this->response->redirect('/users/signup');

    }

    /**
     * Starts a session in the admin backend
     */
    public function loginAction($email = null, $password= null)
    {
        try {
            $this->auth->check([
                'email'    => isset($email) ? $email: $this->request->getPost('login_email'),
                'password' => isset($password) ? $password :$this->request->getPost('login_password'),
                'remember' => $this->request->getPost('login-remember'),
            ]);

            $user = $this->session->get('auth-identity');

            $this->flash->success("Welcome " . $user['name']);
            return $this->response->redirect('/');
            
        } catch (AuthException $e) {
        $this->flash->error($e->getMessage());
        }
    }

    public function loginWithRememberMeAction()
    {
        try {
            return $this->auth->loginWithRememberMe();
        } catch (AuthException $e) {
        $this->flash->error($e->getMessage());
        }
    }

    /**
     * Shows the forgot password form
     */
    public function forgotPasswordAction(): void
    {
        $user = Users::findFirstByEmail($this->request->getPost('email'));
        if (!$user) {return;} 
        else {
            $resetPassword          = new ResetPasswords();
            $resetPassword->usersId = $user->id;
            if ($resetPassword->save()) {
                $this->direct->success('un email a été envoyé');
            } else {
                foreach ($resetPassword->getMessages() as $message) {
                    $this->direct->error((string) $message);
                }
            }
        }
    }



    
    public function confirmEmailAction()
    {
        $code = $this->dispatcher->getParam('code');

        /** @var EmailConfirmations|false $confirmation */
        $confirmation = EmailConfirmations::findFirstByCode($code);
        if (!$confirmation instanceof EmailConfirmations) {
            return $this->dispatcher->forward([
                'controller' => 'index',
                'action'     => 'index',
            ]);
        }

        if ($confirmation->confirmed != 'N') {
            return $this->dispatcher->forward([
                'controller' => 'session',
                'action'     => 'login',
            ]);
        }

        /**
         * Activate user
         */
        $user = Users::findFirst($confirmation->user->id);
        $user->active = 'Y';
        if (!$user->save()) {
            foreach ($confirmation->user->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            return $this->dispatcher->forward([
                'controller' => 'index',
                'action'     => 'index',
            ]);
        }

        /**
         * Change the confirmation to 'confirmed' and update the user to 'active'
         */
        $confirmation->confirmed = 'Y';
        if (!$confirmation->save()) {
            foreach ($confirmation->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            return $this->dispatcher->forward([
                'controller' => 'index',
                'action'     => 'index',
            ]);
        }

        /**
         * Identify the user in the application
         */
        $this->auth->authUserById($confirmation->user->id);

        /**
         * Check if the user must change his/her password
         */
        if ($confirmation->user->mustChangePassword == 'Y') {
            $this->flash->success('The email was successfully confirmed. Now you must change your password');

            return $this->dispatcher->forward([
                'controller' => 'users',
                'action'     => 'changePassword',
            ]);
        }

        $this->flash->success('The email was successfully confirmed');

        return $this->dispatcher->forward([
            'controller' => 'users',
            'action'     => 'index',
        ]);
    }

    public function resetPasswordAction()
    {
        $code = $this->dispatcher->getParam('code');

        /** @var ResetPasswords|false $resetPassword */
        $resetPassword = ResetPasswords::findFirstByCode($code);
        if (!$resetPassword instanceof ResetPasswords) {
            return $this->dispatcher->forward([
                'controller' => 'index',
                'action'     => 'index',
            ]);
        }

        if ($resetPassword->reset != 'N') {
            return $this->dispatcher->forward([
                'controller' => 'session',
                'action'     => 'login',
            ]);
        }

        $resetPassword->reset = 'Y';

        /**
         * Change the confirmation to 'reset'
         */
        if (!$resetPassword->save()) {
            foreach ($resetPassword->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            return $this->dispatcher->forward([
                'controller' => 'index',
                'action'     => 'index',
            ]);
        }

        /**
         * Identify the user in the application
         */
        $this->auth->authUserById($resetPassword->usersId);

        $this->flash->success('Please reset your password');

        return $this->dispatcher->forward([
            'controller' => 'users',
            'action'     => 'changePassword',
        ]);
    }

    /**
     * Closes the session
     */
    public function logoutAction()
    {
        $this->auth->remove();
        return $this->response->redirect('/');
    }
}
