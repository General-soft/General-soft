<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use App\Providers\AuthServiceProvider;
use App\Providers\GoogleDnsServiceProvider;
use App\Providers\RouteServiceProvider;

return [
    AppServiceProvider::class,
    RouteServiceProvider::class,
    AuthServiceProvider::class,
    GoogleDnsServiceProvider::class,
];
