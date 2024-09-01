<?php

declare(strict_types=1);

namespace App\Services\FileValidator\Validators;

use App\Enums\FileValidationResult;
use Illuminate\Support\Facades\Validator;

class HashStructureValidator implements IssuerFileValidator
{
    public function validate(array $data): ?FileValidationResult
    {
        $validator = Validator::make($data, [
            'signature.type' => [
                'required',
                'string',
            ],
            'signature.targetHash' => [
                'required',
                'string',
            ],
        ]);

        if ($validator->fails()) {
            return FileValidationResult::InvalidSignature;
        }

        return null;
    }
}
