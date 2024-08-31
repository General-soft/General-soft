<?php

declare(strict_types=1);

namespace App\Services\FileValidation\Validators;

use App\Enums\FileValidationResult;

interface FileValidator
{
    public function validate(array $data): ?FileValidationResult;
}
