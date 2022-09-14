<?php
declare(strict_types=1);

namespace Base\Providers;

use Phalcon\Events\Event;
use Base\Container\Application;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Di\DiInterface;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

class EventsProvider implements ServiceProviderInterface
{

    protected $providerName = 'eventsManager';


    public function register(DiInterface $di): void
    {

        $application = $di->getShared(Application::APPLICATION_PROVIDER);
        $modules = $application->getModules();
        
        $eventsManager = $di->get($this->providerName);

        //events
        $eventsManager->attach(
            "dispatch:beforeForward", 
            function ($event, $dispatcher, array $forward) 
            use ($modules) {
        
                $metadata = $modules[$forward["module"]]["metadata"];
        
                $dispatcher->setModuleName(
                    $forward["module"]
                );
        
                $dispatcher->setNamespaceName(
                    $metadata["appNamespace"]
                );
            }
        );
        $di->get('dispatcher')->setEventsManager($eventsManager);
    }
}
