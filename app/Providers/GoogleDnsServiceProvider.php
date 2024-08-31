<?php

declare(strict_types=1);

namespace App\Providers;

use App\Exceptions\NotConfigured;
use App\Repositories\GoogleDnsLookupRepository;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class GoogleDnsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(GoogleDnsLookupRepository::class)
            ->needs(PendingRequest::class)
            ->give(function (): PendingRequest {
                return $this->getHttpApi();
            });
    }

    public function getHttpApi(): PendingRequest
    {
        $baseUrl = config('services.google_dns.base_url');

        if (! $baseUrl) {
            throw new NotConfigured;
        }

        return Http::retry(0)
            ->timeout(3)
            ->baseUrl($baseUrl);
    }
}
