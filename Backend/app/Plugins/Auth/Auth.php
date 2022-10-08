<?php
declare(strict_types=1);


namespace Base\Plugins;

use Phalcon\Di\Injectable;
use Phalcon\Http\Response;
use App\Application\Models\FailedLogins;
use App\Application\Models\RememberTokens;
use App\Application\Models\SuccessLogins;
use App\Application\Models\Users;
use Phalcon\Messages\Messages;
use Phalcon\Messages\Message;



class Auth extends Injectable
{

    public Messages $errors ;

    public bool $userExists = false;
    public bool $userClear = true;
    public bool $savedLogin = false;

    public Message $notFound;
    public Message $suspended;
    public Message $banned;
    public Message $deActivated;

    public function __construct(){

        $this->errors = new Messages();
        $this->notFound = new Message('Wrong email/password combination', 'user');
        $this->deActivated  = new Message('The user is inactive', 'user');
        $this->suspended =  new Message('The user is suspended', 'user');
        $this->banned =new Message('The user is banned', 'user');
    }

    public function check($credentials) : bool
    {
        // Check if the user exist
        $user = Users::findFirstByEmail($credentials['email']);

        // check if user exists
        if ($user == true && $this->security->checkHash($credentials['password'], $user->password)){
            $this->userExists = true;
        } 
        else {
            $id = ($user == true) ? $user->id : 0;
            $this->registerUserThrottling($id);
            $this->handleError($this->notFound);
            return false;
        }
        // Check if the user was flagged
        if (!$this->userFlagged($user))
            return $this->userClear = false;

        // Register the successful login
        if (!$this->saveSuccessLogin($user))
            return $this->savedLogin = false;

        // Check if the remember me was selected
        if (isset($credentials['rememberMe'])) {
            $this->createRememberEnvironment($user);
        }

        //log the user
        $this->authUserById($user->id);
        return true;
    }

    public function saveSuccessLogin($user) : bool
    {
        $successLogin            = new SuccessLogins();
        $successLogin->usersId   = $user->id;
        $successLogin->ipAddress = $this->request->getClientAddress();
        $successLogin->userAgent = $this->request->getUserAgent();
        if (!$successLogin->save()) {
            $this-handleError($successLogin->getMessages());
            return false;
        }
        return true;
    }


    public function registerUserThrottling($userId)
    {
        $failedLogin            = new FailedLogins();
        $failedLogin->usersId   = $userId;
        $failedLogin->ipAddress = $this->request->getClientAddress();
        $failedLogin->attempted = time();
        $failedLogin->save();

        $attempts = FailedLogins::count([
            'ipAddress = ?0 AND attempted >= ?1',
            'bind' => [
                $this->request->getClientAddress(),
                time() - 3600 * 6, //attempts on the last 6 hours
            ],
        ]);

        switch ($attempts) {
            case 1:
            case 2:
                // no delay
                break;
            case 3:
            case 4:
                sleep(2);
                break;
            default:
                sleep(4);
                break;
        }
    }


    public function createRememberEnvironment(Users $user)
    {
        $userAgent = $this->request->getUserAgent();
        $token     = md5($user->email . $user->password . $userAgent);

        $remember            = new RememberTokens();
        $remember->usersId   = $user->id;
        $remember->token     = $token;
        $remember->userAgent = $userAgent;

        if ($remember->save() != false) {
            $expire = time() + 86400 * 8;
            $this->cookies->set('RMU', $user->id, $expire);
            $this->cookies->set('RMT', $token, $expire);
        }
    }

    public function hasRememberMe()
    {
        return $this->cookies->has('RMU');
    }

    public function loginWithRememberMe()
    {
        $userId      = $this->cookies->get('RMU')->getValue();
        $cookieToken = $this->cookies->get('RMT')->getValue();

        $user = Users::findFirstById($userId);
        if ($user) {
            $userAgent = $this->request->getUserAgent();
            $token     = md5($user->email . $user->password . $userAgent);

            if ($cookieToken == $token) {
                $remember = RememberTokens::findFirst([
                    'usersId = ?0 AND token = ?1',
                    'bind' => [
                        $user->id,
                        $token,
                    ],
                ]);
                if ($remember) {
                    // Check if the cookie has not expired
                    if (((time() - $remember->createdAt) / (86400 * 8)) < 8) {
                        // Check if the user was flagged
                        $this->userFlagged($user);

                        // Register identity
                        $this->session->set('auth', [
                            'id'      => $user->id,
                            'name'    => $user->name,
                            'profile' => $user->profile->name,
                        ]);

                        // Register the successful login
                        $this->saveSuccessLogin($user);

                        return $this->response->redirect('users');
                    }
                }
            }
        }

        $this->cookies->get('RMU')->delete();
        $this->cookies->get('RMT')->delete();

        return $this->response->redirect('users/login');
    }

    public function userFlagged(Users $user) : bool
    {
        if ($user->active != 'Y') {
            $this->handleError($this->deActivated);
            //do something
        }

        if ($user->banned != 'N') {
            $this->handleError($this->banned);
            return false;
        }
        if ($user->suspended != 'N') {
            $this->handleError($this->suspended);
            return false;
        }
        return true;
    }

    public function getErrors(): \stdClass
    {
        $message = new \stdClass();
        foreach($this->errors as $errorMessage){
            $field = $errorMessage->getField();
            $message->$field = $errorMessage->getMessage();
        }
        return $message;
    }

    public function remove()
    {
        if ($this->cookies->has('RMU')) {
            $this->cookies->get('RMU')->delete();
        }
        if ($this->cookies->has('RMT')) {
            $token = $this->cookies->get('RMT')->getValue();

            $userId = $this->findFirstByToken($token);
            if ($userId) {
                $this->deleteToken($userId);
            }

            $this->cookies->get('RMT')->delete();
        }

        $this->session->remove('auth');
    }

    public function authUserById($id) : bool
    {
        $user = Users::findFirstById($id);
        if (!$user) 
            return false;

       $this->session->set('auth', [
            'id'      => $user->id,
            'name'    => $user->firstName,
            'profile' => $user->profile->name,
        ]);

        return true;
    }


    public function getSession()
    {
        $identity = $this->session->get('auth');
        
        if (!isset($identity)) 
            return false;

        $user = Users::findFirstById($identity['id']);
        return !$user ? false : $identity;
    }


    /**
     * Returns the current token user
     *
     * @param string $token
     *
     * @return int|null
     */
    public function findFirstByToken($token)
    {
        $userToken = RememberTokens::findFirst([
            'conditions' => 'token = :token:',
            'bind'       => [
                'token' => $token,
            ],
        ]);

        return $userToken ? $userToken->usersId : null;
    }

    /**
     * Delete the current user token in session
     *
     * @param int $userId
     */
    public function deleteToken(int $userId): void
    {
        $user = RememberTokens::find([
            'conditions' => 'usersId = :userId:',
            'bind'       => [
                'userId' => $userId,
            ],
        ]);

        if ($user) {
            $user->delete();
        }
    }
    public function handleError(Messages | Message $messages) : void
    {
        if (is_a($messages,'Phalcon\Messages\Message'))
            $this->errors->appendMessage($messages);
        else
        foreach ($messages as $message){
            $this->errors->appendMessage($message);
        }
    }

}
