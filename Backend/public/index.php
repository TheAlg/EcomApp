<?php

use Base\Container\Application as BaseApplication;

error_reporting(E_ALL);
define('BASE_PATH', dirname(__DIR__));

try {
    require_once BASE_PATH . '/vendor/autoload.php';
    require_once BASE_PATH . '/app/base/Application.php';

    $dotenv = Dotenv\Dotenv::createUnsafeImmutable(BASE_PATH);
    $dotenv->load();


    echo (new BaseApplication(BASE_PATH))->run();
} catch (Exception $e) {
    echo $e->getMessage(), '<br>';
    echo nl2br(htmlentities($e->getTraceAsString()));
}



