<?php

declare(strict_types=1);

namespace App\Services\FileValidator\Validators;

use App\Enums\FileValidationResult;
use App\Services\FileValidator\IdentityValidation\IdentityValidator;

class IssuerIdentityValidator implements IssuerFileValidator
{
    public function __construct(
        private IdentityValidator $identityValidator,
    ) {
        //
    }

    public function validate(array $data): ?FileValidationResult
    {
        $key = $data['data']['issuer']['identityProof']['key'] ?? null;
        $location = $data['data']['issuer']['identityProof']['location'] ?? null;

        if (!$key || !$location) {
            return FileValidationResult::InvalidIssuer;
        }

        $isIdentityValid = $this->identityValidator->validateIdentity($location, $key);

        return $isIdentityValid ? null : FileValidationResult::InvalidIssuer;
    }
}
