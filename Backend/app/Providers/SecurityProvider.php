<?php
declare(strict_types=1);

namespace Base\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Encryption\Security;

class SecurityProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'security';

    /**
     * @param DiInterface $di
     *
     * @return void
     */
    public function register(DiInterface $di): void
    {
        $di->set($this->providerName, function () use ($di) {
            $security = new Security();
            $security->setDI($di);

            return $security;
        });
    }
}
