<?php

declare(strict_types=1);

namespace App\Http\Builders\FileValidation;

use App\DTO\FileDTO;
use App\DTO\ValidationRequestDTO;
use App\Http\Builders\DtoBuilderFromRequest;
use Illuminate\Http\Request;

class ValidationRequestBuilder implements DtoBuilderFromRequest
{
    public function build(Request $request): ValidationRequestDTO
    {
        $file = $request->file('file');

        return new ValidationRequestDTO(
            file: new FileDTO($file->path()),
        );
    }
}
