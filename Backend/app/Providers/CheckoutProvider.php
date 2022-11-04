<?php
declare(strict_types=1);

namespace Base\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Base\Plugins\Checkout;

class CheckoutProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'checkout';

    /**
     * @param DiInterface $di
     *
     * @return void
     */
    public function register(DiInterface $di): void
    {
        $di->setShared($this->providerName, function () use ($di) {
                return new Checkout($di->get('cart'));
            }
        );
    }
}
