<?php
declare(strict_types=1);

namespace Base\Container;

use Exception;
use Phalcon\Di\DiInterface;
use Phalcon\Di\FactoryDefault;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Http\ResponseInterface;
use Phalcon\Autoload\Loader;
use Phalcon\Mvc\Application as MvcApplication;


class Application
{
    const APPLICATION_PROVIDER = 'bootstrap';
    
    //
    protected $app;

    protected $di;

    protected $rootPath;

    protected $appPath;

    protected $modules;

    protected $uri;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
        $this->appPath = $this->appPath();
        $this->di = new FactoryDefault();
        $this->app = $this->createApplication();

        $this->di->setShared(self::APPLICATION_PROVIDER, $this);
        $this->initializeLoader();
        $this->registerModules();
        $this->initializeProviders();


    }

    public function run(): string
    {
        $baseUri = $this->di->getShared('url')->getBaseUri();
        $position = strpos($_SERVER['REQUEST_URI'], $baseUri) + strlen($baseUri);
        $uri = '/' . substr($_SERVER['REQUEST_URI'], $position);

        $this->uri = $uri;
        /** @var ResponseInterface $response */
        $response = $this->app->handle($uri);

        return (string)$response->getContent();
    }

    public function getRootPath(): string
    {
        return $this->rootPath;
    }

    public function getCurrentUri(): string
    {
        return $this->uri;
    }

    protected function appPath(): string
    {
        $dir = $this->rootPath . DIRECTORY_SEPARATOR . "app";
        if (!is_dir($dir))
                throw new Exception('app directory does not exist.');

        return $dir;
    }

    public function getAppPath(): string
    {
        return $this->appPath;
    }

    public function getModules() 
    {
        return $this->app->getModules();
    }


    protected function createApplication(): MvcApplication
    {
        return new MvcApplication($this->di);
    }

    /**
     * @throws Exception
     */
    protected function initializeProviders(): void
    {
        $filename = $this->appPath . '/config/providers.php';
        if (!file_exists($filename) || !is_readable($filename)) {
            throw new Exception('File providers.php does not exist or is not readable.');
        }

        $providers = include_once $filename;
        foreach ($providers as $providerClass) {
            /** @var ServiceProviderInterface $provider */
            $provider = new $providerClass;
            $provider->register($this->di);
        }
    }
    protected function initializeLoader() : void 
    {
        $loaderFile = $this->appPath . '/config/Loader.php';
        if (!file_exists($loaderFile) || !is_readable($loaderFile)) {
            throw new Exception('File Loader.php does not exist or is not readable.' . $loaderFile);
        }
        $loaderComponent = new Loader();
        $loaderFile = include $loaderFile;
        
        foreach ($loaderFile['namespaces'] as $namespace => $path){
            $loaderComponent->addNamespace($namespace, $path);
            $directory = new \RecursiveDirectoryIterator($path);
            foreach($directory as $file){
                if ($file->isDir() && substr($file->getPathname(), -1) !== '.'){
                    $loaderComponent->addNamespace($namespace, $file->getPathname());
                }

            }
   
            $loaderComponent->addNamespace($namespace, $path);
        }
        foreach ($loaderFile['files'] as $file){
            $loaderComponent->addFile($file);
        }
        $loaderComponent->register();
    }

    protected function registerModules():void
    {
    $modules = $this->appPath . '/config/Modules.php';
    if (!file_exists($modules) || !is_readable($modules)) {
        throw new Exception('File Modules.php does not exist or is not readable.');
    }
    $modules = include $modules;
    $this->app->registerModules($modules);
    }
    

}

