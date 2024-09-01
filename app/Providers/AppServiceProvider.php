<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\FileValidator\FileValidationService;
use App\Services\FileValidator\IdentityValidation\GoogleDnsIdentityValidator;
use App\Services\FileValidator\IdentityValidation\IdentityValidator;
use App\Services\FileValidator\IssuerDataHasher\IssuerFileDataHasher;
use App\Services\FileValidator\IssuerDataHasher\Sha256IssuerDataFileHasher;
use App\Services\FileValidator\JsonFileValidationService;
use App\Services\FileValidator\Validators\HashStructureValidator;
use App\Services\FileValidator\Validators\HashValidator;
use App\Services\FileValidator\Validators\IssuerFileValidator;
use App\Services\FileValidator\Validators\IssuerIdentityValidator;
use App\Services\FileValidator\Validators\IssuerStructureValidator;
use App\Services\FileValidator\Validators\RecipientStuctureValidator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerIdentityValidator();

        $this->registerIssuerFileDataHasher();

        $this->registerFileValidationService();
    }

    private function registerIdentityValidator(): void
    {
        $this->app->bind(IdentityValidator::class, GoogleDnsIdentityValidator::class);
    }

    private function registerIssuerFileDataHasher(): void
    {
        $this->app->bind(IssuerFileDataHasher::class, Sha256IssuerDataFileHasher::class);
    }

    private function registerFileValidationService(): void
    {
        $this->app->tag(
            abstracts: [
                RecipientStuctureValidator::class,
                IssuerStructureValidator::class,
                HashStructureValidator::class,
                HashValidator::class,
                IssuerIdentityValidator::class,
            ],
            tags: IssuerFileValidator::class,
        );

        $this->app->bind(JsonFileValidationService::class, static function (Application $container): FileValidationService {
            $validators = $container->tagged(IssuerFileValidator::class);

            return new JsonFileValidationService(iterator_to_array($validators));
        });
    }
}
