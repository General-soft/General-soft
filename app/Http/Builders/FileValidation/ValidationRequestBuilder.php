<?php

declare(strict_types=1);

namespace App\Http\Builders\FileValidation;

use App\DTO\FileDTO;
use App\DTO\ValidationRequestDTO;
use App\Enums\FileType;
use App\Http\Builders\DtoBuilderFromRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use InvalidArgumentException;

class ValidationRequestBuilder implements DtoBuilderFromRequest
{
    public function build(Request $request): ValidationRequestDTO
    {
        $file = $request->file('file');

        return new ValidationRequestDTO(
            file: new FileDTO($file->path()),
            fileType: $this->getFileType($file),
        );
    }

    private function getFileType(UploadedFile $file): FileType
    {
        return match ($file->getClientMimeType()) {
            'application/json' => FileType::Json,
            default => new InvalidArgumentException('Unknown file mime'),
        };
    }
}
