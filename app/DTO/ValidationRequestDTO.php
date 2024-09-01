<?php

declare(strict_types=1);

namespace App\DTO;

use App\Enums\FileType;

readonly class ValidationRequestDTO
{
    public function __construct(
        private FileDTO $file,
        private FileType $fileType,
    ) {
        //
    }

    public function getFile(): FileDTO
    {
        return $this->file;
    }

    public function getFileType(): FileType
    {
        return $this->fileType;
    }
}
