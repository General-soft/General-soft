<?php

declare(strict_types=1);

namespace App\Factories;

use App\Enums\FileType;
use App\Services\FileValidator\FileValidationService;
use App\Services\FileValidator\JsonFileValidationService;

class FileValidationFactory
{
    public function validationService(FileType $fileType): FileValidationService
    {
        return match ($fileType) {
            FileType::Json => app(JsonFileValidationService::class),
        };
    }
}
