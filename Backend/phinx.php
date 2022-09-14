<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();
//$dotenv->required(['DEPLOY_PATH'])->notEmpty();

return
[
    'paths' => [
        'migrations' => [
            'Base\\Migrations\users' => '%%PHINX_CONFIG_DIR%%/db/migrations/users',
            'Base\\Migrations\products' => '%%PHINX_CONFIG_DIR%%/db/migrations/products',
            'Base\\Migrations\Cart' => '%%PHINX_CONFIG_DIR%%/db/migrations/cart',
            'Base\\Migrations\Banner' => '%%PHINX_CONFIG_DIR%%/db/migrations/banners',

        ],
        'seeds' => [
            'Base\\Seeds\Users' => '%%PHINX_CONFIG_DIR%%/db/seeds/users',
            'Base\\Seeds\Products' => '%%PHINX_CONFIG_DIR%%/db/seeds/products',
            'Base\\Seeds\Cart' => '%%PHINX_CONFIG_DIR%%/db/seeds/cart',
            'Base\\Seeds\Banner' => '%%PHINX_CONFIG_DIR%%/db/seeds/banners',


        ],
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'development',
        'development' => [
            'adapter' => strtolower(getenv('DB_ADAPTER')),
            'host' => getenv('DB_HOST'),
            'name' => strtolower(getenv('DB_ADAPTER')) === 'sqlite' ?
                '%%PHINX_CONFIG_DIR%%/db/' . getenv('DB_NAME') :
                getenv('DB_NAME'),
            'user' => getenv('DB_USERNAME'),
            'pass' => getenv('DB_PASSWORD'),
            'port' => getenv('DB_PORT'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ],
    'version_order' => 'creation'
];