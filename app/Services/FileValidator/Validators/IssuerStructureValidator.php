<?php

declare(strict_types=1);

namespace App\Services\FileValidator\Validators;

use App\Enums\FileValidationResult;
use Illuminate\Support\Facades\Validator;

class IssuerStructureValidator implements IssuerFileValidator
{
    public function __construct() {}

    public function validate(array $data): ?FileValidationResult
    {
        $validator = Validator::make($data, [
            'data.issuer.name' => [
                'required',
            ],
            'data.issuer.identityProof' => [
                'required',
                'array:type,key,location',
            ],
            'data.issuer.identityProof.type' => [
                'required',
                'string',
            ],
            'data.issuer.identityProof.key' => [
                'required',
                'string',
            ],
            'data.issuer.identityProof.location' => [
                'required',
                'string',
            ],
        ]);

        if ($validator->fails()) {
            return FileValidationResult::InvalidIssuer;
        }

        return null;
    }
}
