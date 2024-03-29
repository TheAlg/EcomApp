<?php
declare(strict_types=1);

namespace Base\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Base\Container\Application;
use Base\Plugins\InputProcessor;



class formsProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'forms';


    public function register(DiInterface $di): void
    {
        $di->setShared($this->providerName, function () {
            return new InputProcessor();
        });
    }


}