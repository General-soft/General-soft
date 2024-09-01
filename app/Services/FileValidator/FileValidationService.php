<?php

declare(strict_types=1);

namespace App\Services\FileValidator;

use App\DTO\ValidationRequestDTO;
use App\DTO\ValidationResultDTO;

interface FileValidationService
{
    public function validateFileRequest(ValidationRequestDTO $validationRequest): ValidationResultDTO;
}
