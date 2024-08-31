<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Laravel\Passport\PersonalAccessTokenResult;

class AuthTokenService
{
    public function create(User $user, string $name): PersonalAccessTokenResult
    {
        return $user->createToken($name);
    }
}
