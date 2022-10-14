<?php
use function Base\Container\app_path;

use App\Api\Module as ApiModule;

return 
[
    "api" => [
        "className" => ApiModule::class,
        "path"      =>  app_path() ."/modules/api/Module.php",
        "metadata"  => [
            "appNamespace" => "App\Api\Controllers",
        ],
    ],
];
