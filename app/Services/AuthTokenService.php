<?php

namespace App\Services;

use App\Models\User;
use Laravel\Passport\PersonalAccessTokenResult;
use Laravel\Passport\Token;
use Laravel\Passport\TokenRepository;

class AuthTokenService
{
    public function create(User $user, string $name): PersonalAccessTokenResult
    {
        return $user->createToken($name);
    }
}
