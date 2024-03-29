<?php
declare(strict_types=1);

use Base\Providers\AclProvider;
use Base\Providers\AuthProvider;
use Base\Providers\ConfigProvider;
use Base\Providers\CryptProvider;
use Base\Providers\DbProvider;
use Base\Providers\DispatcherProvider;
use Base\Providers\LoggerProvider;
use Base\Providers\MailProvider;
use Base\Providers\ModelsMetadataProvider;
use Base\Providers\RouterProvider;
use Base\Providers\SecurityProvider;
use Base\Providers\SessionBagProvider;
use Base\Providers\SessionProvider;
use Base\Providers\UrlProvider;
use Base\Providers\ViewProvider;
use Base\Providers\EventsProvider;
use Base\Providers\CartProvider;
use Base\Providers\ModelsManagerProvider;
use Base\Providers\ResponseProvider;
use Base\Providers\modelsBuilderProvider;
use Base\Providers\formsProvider;
use Base\Providers\CheckoutProvider;



return [
    AclProvider::class,
    AuthProvider::class,
    ConfigProvider::class,
    CryptProvider::class,
    DbProvider::class,
    DispatcherProvider::class,
    LoggerProvider::class,
    MailProvider::class,
    RouterProvider::class,
    SessionBagProvider::class,
    SessionProvider::class,
    SecurityProvider::class,
    UrlProvider::class,
    CartProvider::class,
    EventsProvider::class,
    ViewProvider::class,
    ModelsManagerProvider::class,
    ResponseProvider::class,
    modelsBuilderProvider::class,
    formsProvider::class,
    CheckoutProvider::class
    
];
