<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Enums\GrantType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    schema: 'AuthenticateUserByPasswordRequest',
    required: ['grant_type', 'email', 'password'],
    properties: [
        new Property(
            property: 'grant_type',
            description: 'The method user for authentication.',
            type: 'string',
            enum: GrantType::class,
            example: GrantType::Password->value,
        ),
        new Property(
            property: 'email',
            description: 'The email address of the user',
            type: 'string',
            format: 'email',
            example: 'test@example.com',
        ),
        new Property(
            property: 'password',
            description: 'The password of the user',
            type: 'string',
            example: 'test',
        ),
    ],
)]
class AuthenticateUserRequest extends FormRequest
{
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
