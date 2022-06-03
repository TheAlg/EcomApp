<?php

namespace App\Backend;

use Phalcon\Autoload\Loader;
use Phalcon\Di\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\ModuleDefinitionInterface;
use App\Helpers\Cart\CartShopping;
use Phalcon\Session\Adapter\Stream as SessionAdapter;
use Phalcon\Session\Manager as SessionManager;
use Phalcon\Events\Manager as EventsManager;


class Module implements ModuleDefinitionInterface
{

    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->addNamespace("App\Backend\Controllers",BASE_PATH.'/app/modules/backend/controllers/');
                



        $loader->register();
    }
    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        // Registering a dispatcher
        return $di->get("dispatcher")->setDefaultNamespace('App\Backend\Controllers\\');
        /**
         * Start the session the first time some component request the session service
         */

    }
}
