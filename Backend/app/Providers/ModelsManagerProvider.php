<?php
declare(strict_types=1);

namespace Base\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Base\Plugins\Products;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Model\Manager;

class ModelsManagerProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'modelsManager';

    /**
     * @param DiInterface $di
     *
     * @return void
     */
    public function register(DiInterface $di): void
    {
        $di->set($this->providerName, function () {
            $modelsManager = new Manager();
            return $modelsManager;
        });
    }
}
