<?php
declare(strict_types=1);

namespace Base\Providers;

use Phalcon\Config;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\View;
use function Base\Container\getCurrentUri;
use App\Application\Models\Users;


class ViewProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'view';

    /**
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $config = $di->getShared('config');
        $viewsDir = $config->path('application.viewsDir');

        $di->setShared($this->providerName, function () use ($viewsDir, $di) {
            $view = new View();
            //globale variables
            $view->url = getCurrentUri();
            $view->setViewsDir($viewsDir);
            return $view;
        });
    }
}
