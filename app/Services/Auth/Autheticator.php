<?php

namespace App\Services\Auth;

use App\Models\User;

interface Autheticator
{
    public function autheticate(array $data): ?User;
}
