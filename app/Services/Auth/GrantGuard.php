<?php

namespace App\Services\Auth;

use App\Models\User;
use Hash;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Validator;

class GrantGuard implements Guard
{
    use GuardHelpers;

    public function __construct(
        private readonly Request $request,
        private Autheticator $autheticator,
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
        return $this->autheticator->autheticate($data);
    }

    public function validate(array $credentials = [])
    {
        return true;
    }
}
