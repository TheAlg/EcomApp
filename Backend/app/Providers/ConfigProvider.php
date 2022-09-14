<?php
declare(strict_types=1);

namespace Base\Providers;

use Phalcon\Config\Config;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Base\Container\Application;

/**
 * Register the global configuration as config
 */
class ConfigProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'config';

    /**
     * @param DiInterface $di
     *
     * @return void
     */
    public function register(DiInterface $di): void
    {
        /** @var Application $application */
        $application = $di->getShared(Application::APPLICATION_PROVIDER);
        /** @var string $rootPath */
        $appPath = $application->getAppPath();

        $di->setShared($this->providerName, function () use ($appPath) {
            $config = include $appPath . '/config/config.php';

            return new Config($config);
        });
    }
}
