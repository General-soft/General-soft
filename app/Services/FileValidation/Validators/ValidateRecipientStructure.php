<?php

declare(strict_types=1);

namespace App\Services\FileValidation\Validators;

use App\Enums\FileValidationResult;
use Illuminate\Support\Facades\Validator;

class ValidateRecipientStructure implements FileValidator
{
    public function validate(array $data): ?FileValidationResult
    {
        $validator = Validator::make($data, [
            'data.recipient.name' => [
                'required',
                'string',
            ],
            'data.recipient.email' => [
                'required',
                'string',
            ],
        ]);

        if ($validator->fails()) {
            return FileValidationResult::InvalidRecipient;
        }

        return null;
    }
}
