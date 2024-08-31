<?php

declare(strict_types=1);

namespace App\Services\FileValidation\IdentityValidation;

interface IdentityValidator
{
    public function validateIdentity(string $domain, string $key): bool;
}
