<?php

namespace App\Http\Controllers\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Passport\PersonalAccessTokenResult;

/**
 * @mixin PersonalAccessTokenResult
 */
class TokenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->accessToken,
            'id' => $this->token->id,
            'user_id' => $this->token->user->id,
        ];
    }
}
