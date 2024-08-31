<?php

declare(strict_types=1);

namespace App\DTO;

readonly class FileDTO
{
    public function __construct(
        private string $filePath,
    ) {
        //
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }
}
