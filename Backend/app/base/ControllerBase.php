<?php
declare(strict_types=1);

namespace Base\App;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Http\Response;
use Base\Plugins\Acl;
use Base\Plugins\Auth;


/**
 * ControllerBase
 * This is the base controller for all controllers in the application
 *
 * @property Auth auth
 * @property Acl  acl
 */
class ControllerBase extends Controller
{

    public $postData;
    /**
     * Execute before the router so we can determine if this is a private
     * controller, and must be authenticated, or a public controller that is
     * open to all.
     *
     * @param Dispatcher $dispatcher
     *
     * @return boolean
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher): bool
    {

        $controllerName = $dispatcher->getControllerName();
        $actionName     = $dispatcher->getActionName();
        $module         = $dispatcher->getModuleName();


        if ($module === 'api'){
            $this->view->disable();
            if($this->request->isPost() && !$this->forms->isValid()){
                $this->response->setJsonContent([
                    "complete" => false,
                    "message" => $this->forms->getErrors()
                ]);
                $this->response->send();
                return false;
            }
            //getpost is never empty
            else $this->postData = $this->forms->getPost();
        }
        
        // Only check permissions on private controllers
        /*if ($this->acl->isPrivate($controllerName)) {
            // Get the current identity
            $identity = $this->auth->getIdentity();

            // If there is no identity available the user is redirected to index/index
            if (!is_array($identity)) {
                $this->flash->notice('You don\'t have access to this module: private');

                $dispatcher->forward([
                    'controller' => 'index',
                    'action'     => 'index',
                ]);
                return false;
            }

            // Check if the user have permission to the current option
            if (!$this->acl->isAllowed($identity['profile'], $controllerName, $actionName)) {
                $this->flash->notice('You don\'t have access to this module: ' . $controllerName . ':' . $actionName);

                if ($this->acl->isAllowed($identity['profile'], $controllerName, 'index')) {
                    $dispatcher->forward([
                        'controller' => $controllerName,
                        'action'     => 'index',
                    ]);
                } else {
                    $dispatcher->forward([
                        'controller' => 'index',
                        'action'     => 'index',
                    ]);
                }

                return false;
            }
        }*/
        return true;
    }
    public function afterExecuteRoute(Dispatcher $dispatcher)
    {
        $controllerName = $dispatcher->getControllerName();
        $actionName     = $dispatcher->getActionName();
        $returnedValue = $dispatcher->getReturnedValue();


        if ($dispatcher->getModuleName() === "api" )
        $this->response->setContent(json_encode($returnedValue));
        $this->response->send();
        return false; 



        /*if ($dispatcher->getModuleName() === "backend" && $controllerName === "account" )
            {
                $previousController = $this->dispatcher->getPreviousControllerName();
                $this->response->redirect('/'. $previousController);
            }*/
    }

    public function getPost(){
        return $this->postData; //valid, sanitized and never empty
    }

    public function handleError(Messages | array $messages) : \stdClass
    {
        $errorMessages = new \stdClass;
        foreach ($messages as $message){
            $field = $message->getField();
            $errorMessages->$field = $message->getMessage();
        }
        return $errorMessages;
    }

}
