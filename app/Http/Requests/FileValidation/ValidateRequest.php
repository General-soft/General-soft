<?php

declare(strict_types=1);

namespace App\Http\Requests\FileValidation;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    schema: 'ValidateRequest',
    required: ['file'],
    properties: [
        new Property(
            property: 'file',
            description: 'File that should be validated',
            type: 'file',
        ),
    ],
)]
class ValidateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'max:'. 2 * 1024,
                'extensions:json',
                'mimetypes:application/json',
            ],
        ];
    }
}
