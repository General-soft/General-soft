<?php

declare(strict_types=1);

namespace App\Http\Resources\FileValidation;

use App\DTO\ValidationResultDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ValidationResultDTO
 */
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
