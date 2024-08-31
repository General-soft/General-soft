<?php

declare(strict_types=1);

namespace App\DTO;

use App\Enums\FileValidationResult;
use App\Enums\Issuer;

readonly class ValidationResultDTO
{
    public function __construct(
        private Issuer $issuer,
        private FileValidationResult $result,
    ) {
        //
    }

    public function getIssuer(): Issuer
    {
        return $this->issuer;
    }

    public function getResult(): FileValidationResult
    {
        return $this->result;
    }
}
