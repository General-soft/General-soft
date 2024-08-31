<?php

declare(strict_types=1);

namespace App\Services\Auth\Authenticator;

use App\Models\User;

interface Authenticator
{
    public function authenticate(array $data): ?User;
}
