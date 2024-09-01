<?php

declare(strict_types=1);

namespace App\Services\Auth\Authenticator;

use App\Models\User;
use Illuminate\Validation\ValidationException;

interface Authenticator
{
    /**
     * @param array $data
     * @return ?User
     *
     * @throws ValidationException
     */
    public function authenticate(array $data): ?User;
}
