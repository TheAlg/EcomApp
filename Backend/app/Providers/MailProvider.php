<?php
declare(strict_types=1);

namespace Base\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Vokuro\Plugins\Mail\Mail;

class MailProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'mail';

    /**
     * @param DiInterface $di
     *
     * @return void
     */
    public function register(DiInterface $di): void
    {
        $di->set($this->providerName, Mail::class);
    }
}
