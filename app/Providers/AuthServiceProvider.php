<?php

namespace App\Providers;

use App\Services\Auth\Autheticator;
use App\Services\Auth\GrantGuard;
use App\Services\Auth\PasswordAutheticator;
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
            abstract: Autheticator::class,
            concrete: PasswordAutheticator::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Auth::extend(
            'grant',
            fn(Application $app, string $name, array $config) => new GrantGuard(
                $app->make('request'),
                app(Autheticator::class),
            ),
        );
    }
}
