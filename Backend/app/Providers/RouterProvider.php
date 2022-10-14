<?php
declare(strict_types=1);

namespace Base\Providers;

use Exception;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Router;
use Base\Container\Application;

class RouterProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'router';

    /**
     * @param DiInterface $di
     *
     * @return void
     */
    public function register(DiInterface $di): void
    {
        /** @var Application $application */
        $application = $di->getShared(Application::APPLICATION_PROVIDER);
        /** @var string $basePath */
        $basePath = $application->getAppPath();

        $di->set($this->providerName, function () use ($basePath) {
            $router = new Router();

            $routes = $basePath . '/config/routes.php';
            $router->setDefaultModule('api');
            require_once $routes;
            
            $router->addGet('/auth/getCurrentSession', [
                "module"     => "api",
                'controller' => 'Session',
                'action'     => 'getCurrentSession',
            ]
            );
            return $router;
        });
    }
}
