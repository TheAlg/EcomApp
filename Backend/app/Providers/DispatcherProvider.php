<?php
declare(strict_types=1);

namespace Base\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Dispatcher;

class DispatcherProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'dispatcher';

    /**
     * @param DiInterface $di
     *
     * @return void
     */
    public function register(DiInterface $di): void
    {
        $di->set($this->providerName, function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('App\Api\Controllers');
            return $dispatcher;
        },
        true
    );
    }
}
