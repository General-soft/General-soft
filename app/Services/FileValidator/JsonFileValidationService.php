<?php

declare(strict_types=1);

namespace App\Services\FileValidator;

use App\DTO\ValidationRequestDTO;
use App\DTO\ValidationResultDTO;
use App\Enums\FileValidationResult;
use App\Enums\Issuer;
use App\Services\FileValidator\Validators\IssuerFileValidator;

class JsonFileValidationService implements FileValidationService
{
    /**
     * @var IssuerFileValidator[]
     */
    public function __construct(
        private array $validators,
    ) {
        //
    }

    public function validateFileRequest(ValidationRequestDTO $validationRequest): ValidationResultDTO
    {
        $json = json_decode(file_get_contents($validationRequest->getFile()->getFilePath()), true);

        foreach ($this->validators as $validator) {
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
