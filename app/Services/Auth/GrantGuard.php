<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Auth\Authenticator\Authenticator;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class GrantGuard implements Guard
{
    use GuardHelpers;

    public function __construct(
        private readonly Request $request,
        private readonly Authenticator $authenticator,
    ) {
        //
    }

    public function user()
    {
        if ($this->hasUser()) {
            return $this->user;
        }

        $this->setUser($this->authenticateUser($this->request->all()));

        return $this->user;
    }

    public function authenticateUser(array $data): ?User
    {
        return $this->authenticator->authenticate($data);
    }

    public function validate(array $credentials = [])
    {
        return true;
    }
}
