<?php

declare(strict_types=1);

namespace App\Services\FileValidator\IdentityValidation;

interface IdentityValidator
{
    public function validateIdentity(string $domain, string $key): bool;
}
