<?php

declare(strict_types=1);

namespace App\Services\Auth\Authenticator;

use App\Models\User;
use Illuminate\Validation\ValidationException;

interface Authenticator
{
    /**
     * @throws ValidationException
     */
    public function authenticate(array $data): ?User;
}
