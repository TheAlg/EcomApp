<?php
declare(strict_types=1);

namespace Base\Providers;

use Phalcon\html\Escaper;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Flash\Direct as direct;

class DirectProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'direct';

    /**
     * @param DiInterface $di
     *
     * @return void
     */
    public function register(DiInterface $di): void
    {
        $di->setShared($this->providerName, function () {

            $escaper = new Escaper();
            $flash = new direct($escaper);
            $flash->setImplicitFlush(false);
            $flash->setCssClasses([
                'error'   => 'alert alert-danger',
                'success' => 'alert alert-success',
                'notice'  => 'alert alert-info',
                'warning' => 'alert alert-warning',
            ]);

            return $flash;
        });
    }
}
