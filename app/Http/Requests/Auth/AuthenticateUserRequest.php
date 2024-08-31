<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Enums\GrantType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AuthenticateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'grant_type' => [
                'required',
                'string',
                new Enum(GrantType::class),
            ],
        ];
    }
}
