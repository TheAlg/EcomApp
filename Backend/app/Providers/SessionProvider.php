<?php
declare(strict_types=1);

namespace Base\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Session\Adapter\Stream as SessionAdapter;
use Phalcon\Session\Manager as SessionManager;

class SessionProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'session';

    /**
     * @param DiInterface $di
     *
     * @return void
     */
    public function register(DiInterface $di): void
    {
        /** @var string $savePath */

        $handler  = new SessionAdapter([
            'savePath' => $di->getShared('config')->path('application.sessionSavePath'),
        ]);

        $di->setShared($this->providerName, function () use ($handler) {
            $session = new SessionManager();
            $session->setAdapter($handler);
            $session->setId('session_id');

            $session->start();

            return $session;
        });
    }
}
