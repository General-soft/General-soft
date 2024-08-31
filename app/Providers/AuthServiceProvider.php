<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Auth\Authenticator\Authenticator;
use App\Services\Auth\Authenticator\PasswordAuthenticator;
use App\Services\Auth\GrantGuard;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            abstract: Authenticator::class,
            concrete: PasswordAuthenticator::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $asd = [
            1,
            2,
        ];
        Auth::extend(
            'grant',
            fn (Application $app, string $name, array $config) => new GrantGuard(
                $app->make('request'),
                app(Authenticator::class),
            ),
        );
    }
}
