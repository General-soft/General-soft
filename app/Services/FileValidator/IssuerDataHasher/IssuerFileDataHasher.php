<?php

declare(strict_types=1);

namespace App\Services\FileValidator\IssuerDataHasher;

interface IssuerFileDataHasher
{
    public function hashFileData(array $data): string;
}
