<?php

namespace App\Frontend;
use Phalcon\Events\Event;

use Phalcon\Autoload\Loader;
use Phalcon\Di\DiInterface;
//use Phalcon\Mvc\Dispatcher;
use App\Helpers\manager as Dispatcher;
 
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\ModuleDefinitionInterface;


class Module implements ModuleDefinitionInterface
{
    /**
     * Registers the module auto-loader
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();
        $loader->addNamespace("App\Frontend\Controllers", BASE_PATH.'/app/modules/frontend/controllers/');
      

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {

    $eventsManager = new \Phalcon\Events\Manager();
    $eventsManager->attach("dispatch:beforeException", function($event, $dispatcher, $exception) {
    //Handle 404 exceptions
    if ($exception instanceof \Phalcon\Mvc\Dispatcher\Exception) {
        $dispatcher->forward(array(
            'module' => 'frontend',
            'controller' => 'view',
            'action' => 'error404'
        ));
        return false;
    }
    $dispatcher =  $di->get("dispatcher");
    $dispatcher->setEventsManager($eventsManager);
    //$dispatcher->setDefaultNamespace('App\Frontend\Controllers\\');
    return $dispatcher;
        }, 
     );
    }
}
