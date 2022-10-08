<?php
use function Base\Container\app_path;

use App\Frontend\Module as FrontendModule;
use App\Backend\Module as BackendModule;
use App\Api\Module as ApiModule;

return 
[
    "frontend" => [
        "className" => FrontendModule::class,
        "path"      => app_path() ."modules/frontend/Module.php",
        "metadata"  => [
            "appNamespace" => "App\Frontend\Controllers",
        ],
    ],
    "backend" => [
        "className" => BackendModule::class,
        "path"      =>  app_path() ."modules/backend/Module.php",
        "metadata"  => [
            "appNamespace" => "App\Backend\Controllers",
        ],
    ],
    "api" => [
        "className" => ApiModule::class,
        "path"      =>  app_path() ."/modules/api/Module.php",
        "metadata"  => [
            "appNamespace" => "App\Api\Controllers",
        ],
    ],
];
