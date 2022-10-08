<?php
declare(strict_types=1);

namespace Base\Providers;

use Exception;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Base\Plugins\Builder;


class modelsBuilderProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'builder';

    /**
     * @param DiInterface $di
     *
     * @return void
     */
    public function register(DiInterface $di): void
    {        
        $di->set($this->providerName, function () {
            return new Builder();
        });
    }
}
