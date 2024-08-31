<?php

declare(strict_types=1);

namespace App\Http\Requests\FileValidation;

use Illuminate\Foundation\Http\FormRequest;

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
