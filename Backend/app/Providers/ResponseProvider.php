<?php
declare(strict_types=1);

namespace Base\Providers;

use Exception;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Http\Response;


class ResponseProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'response';

    /**
     * @param DiInterface $di
     *
     * @return void
     */
    public function register(DiInterface $di): void
    {        
        $di->set($this->providerName, function () {
            return new Response();
        });
    }
}
