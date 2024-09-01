<?php

declare(strict_types=1);

namespace App\Services\FileValidator\Validators;

use App\Enums\FileValidationResult;

interface IssuerFileValidator
{
    public function validate(array $data): ?FileValidationResult;
}
