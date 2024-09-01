<?php

declare(strict_types=1);

namespace App\Services\FileValidator\Validators;

use App\Enums\FileValidationResult;
use App\Services\FileValidator\IssuerDataHasher\IssuerFileDataHasher;

class HashValidator implements IssuerFileValidator
{
    public function __construct(
        private IssuerFileDataHasher $fileDataHasher,
    ) {
        //
    }

    public function validate(array $data): ?FileValidationResult
    {
        $targetHash = $data['signature']['targetHash'] ?? null;
        $documentHash = $this->fileDataHasher->hashFileData($data['data'] ?? []);

        if (!$targetHash) {
            return FileValidationResult::InvalidSignature;
        }

        return $documentHash === $targetHash ? null : FileValidationResult::InvalidSignature;
    }
}
