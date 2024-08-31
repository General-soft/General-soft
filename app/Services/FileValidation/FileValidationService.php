<?php

declare(strict_types=1);

namespace App\Services\FileValidation;

use App\DTO\ValidationRequestDTO;
use App\DTO\ValidationResultDTO;
use App\Enums\FileValidationResult;
use App\Enums\Issuer;
use App\Services\FileValidation\Validators\FileValidator;
use App\Services\FileValidation\Validators\ValidateHash;
use App\Services\FileValidation\Validators\ValidateHashStructure;
use App\Services\FileValidation\Validators\ValidateIssuerIdentity;
use App\Services\FileValidation\Validators\ValidateIssuerStructure;
use App\Services\FileValidation\Validators\ValidateRecipientStructure;

class FileValidationService
{
    public function validateFileRequest(ValidationRequestDTO $validationRequest): ValidationResultDTO
    {
        $json = json_decode(file_get_contents($validationRequest->getFile()->getFilePath()), true);

        /** @var FileValidator[] $validators */
        $validators = [
            app(ValidateRecipientStructure::class),
            app(ValidateIssuerStructure::class),
            app(ValidateHashStructure::class),
            app(ValidateIssuerIdentity::class),
            app(ValidateHash::class),
        ];

        foreach ($validators as $validator) {
            $validationResult = $validator->validate($json);

            if ($validationResult !== null) {
                return new ValidationResultDTO(
                    issuer: Issuer::Accredify, result: $validationResult,
                );
            }
        }

        return new ValidationResultDTO(
            issuer: Issuer::Accredify, result: FileValidationResult::Verified,
        );
    }
}
