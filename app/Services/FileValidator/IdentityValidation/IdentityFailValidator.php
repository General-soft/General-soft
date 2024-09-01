<?php

declare(strict_types=1);

namespace App\Services\FileValidator\IdentityValidation;

class IdentityFailValidator implements IdentityValidator
{
    public function validateIdentity(string $domain, string $key): bool
    {
        return false;
    }
}
