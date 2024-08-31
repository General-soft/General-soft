<?php

declare(strict_types=1);

namespace App\Services\FileValidation\Validators;

use App\Enums\FileValidationResult;
use Arr;

class ValidateHash implements FileValidator
{
    public function validate(array $data): ?FileValidationResult
    {
        $dataDotNotation = $this->transformToDotNotation($data['data']);
        $targetHash = $data['signature']['targetHash'];

        $hashesPerDocumentLine = [];
        foreach ($dataDotNotation as $key => $value) {
            $hashesPerDocumentLine[] = $this->hashArray([$key => $value]);
        }

        $hashesPerDocumentLine = array_values(Arr::sort($hashesPerDocumentLine));

        $documentHash = $this->hashArray($hashesPerDocumentLine);

        return $documentHash === $targetHash ? null : FileValidationResult::InvalidSignature;
    }

    private function transformToDotNotation(array $data): array
    {
        return Arr::dot($data);
    }

    private function hashArray(array $data): string
    {
        return hash('sha256', json_encode($data));
    }
}
