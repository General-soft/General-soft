<?php

declare(strict_types=1);

namespace App\Http\Resources\FileValidation;

use App\DTO\ValidationResultDTO;
use App\Enums\FileValidationResult;
use App\Enums\Issuer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

/**
 * @mixin ValidationResultDTO
 */
#[Schema(
    schema: 'ValidationResultResource',
    required: ['issuer', 'result'],
    properties: [
        new Property(
            property: 'issuer',
            description: 'Validated file issuer',
            type: 'string',
            enum: Issuer::class,
            example: Issuer::Accredify->value,
        ),
        new Property(
            property: 'result',
            description: 'Result of validation',
            type: 'string',
            enum: FileValidationResult::class,
            example: FileValidationResult::Verified->value,
        ),
    ],
)]
class ValidationResultResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'issuer' => $this->getIssuer(),
            'result' => $this->getResult(),
        ];
    }
}
