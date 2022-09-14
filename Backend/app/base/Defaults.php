<?php
declare(strict_types=1);

namespace Base\Container;

use Phalcon\Di\Di;
use Phalcon\Di\DiInterface;

function container()
{
    $default = Di::getDefault();
    $args    = func_get_args();
    if (empty($args)) {
        return $default;
    }
    return call_user_func_array([$default, 'get'], $args);
}

function root_path(string $prefix = ''): string
{
    /** @var Application $application */
    $application = container(Application::APPLICATION_PROVIDER);

    return join(DIRECTORY_SEPARATOR, [$application->getRootPath(), ltrim($prefix, DIRECTORY_SEPARATOR)]);
}

function app_path(string $prefix = ''): string
{
    /** @var Application $application */
    $application = container(Application::APPLICATION_PROVIDER);
    return join(DIRECTORY_SEPARATOR, [$application->getAppPath(), ltrim($prefix, DIRECTORY_SEPARATOR)]) ;
}

function getCurrentUri() : string
{
    $application = container(Application::APPLICATION_PROVIDER);
    return $application->getCurrentUri();
}
