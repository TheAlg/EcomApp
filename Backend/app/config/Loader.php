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
        "App\Application\Models"        =>BASE_PATH.'/app/Models/',

    ],
    "files" =>[
        BASE_PATH.'/app/base/Defaults.php',
    ],
    "classes"=>[
    ]
];

