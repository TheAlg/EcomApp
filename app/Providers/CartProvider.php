<?php
declare(strict_types=1);

namespace Base\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Base\Plugins\CartShopping;

class CartProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'cart';

    /**
     * @param DiInterface $di
     *
     * @return void
     */
    public function register(DiInterface $di): void
    {
        $di->setShared($this->providerName, function () use ($di) {
                return new CartShopping( $di->getSession(), 'compare');
            }
        );
    }
}
