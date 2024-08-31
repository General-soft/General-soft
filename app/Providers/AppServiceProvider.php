<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\FileValidation\IdentityValidation\GoogleDnsIdentityValidator;
use App\Services\FileValidation\IdentityValidation\IdentityValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IdentityValidator::class, GoogleDnsIdentityValidator::class);
    }
}
