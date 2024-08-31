<?php

declare(strict_types=1);

namespace App\DTO;

readonly class ValidationRequestDTO
{
    public function __construct(
        private FileDTO $file,
    ) {
        //
    }

    public function getFile(): FileDTO
    {
        return $this->file;
    }
}
