<?php 
return 
[
    "namespaces" =>[
        "Base\App"                      =>BASE_PATH.'/app/base',
        "Base\Container"                =>BASE_PATH.'/app/base',
        "Base\Migrations"               =>BASE_PATH.'/db/migrations',
        "Base\Seeds"                    =>BASE_PATH.'/db/seeds',
        "Base\Plugins"                  =>BASE_PATH.'/app/plugins',
        "Base\Providers"                =>BASE_PATH.'/app/providers',
        "App\Forms"                     =>BASE_PATH.'/app/Forms',
        "App\Application\Models"        =>BASE_PATH.'/app/Models/',
        "App\Backend\Controllers"       =>BASE_PATH.'/app/modules/backend/controllers',

    ],
    "files" =>[
        BASE_PATH.'/app/base/Defaults.php',
    ],
    "classes"=>[
    ]
];

