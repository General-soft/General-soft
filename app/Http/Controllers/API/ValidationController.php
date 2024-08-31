<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Builders\FileValidation\ValidationRequestBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileValidation\ValidateRequest;
use App\Http\Resources\FileValidation\ValidationResultResource;
use App\Services\FileValidation\FileValidationService;
use Illuminate\Http\Response;

class ValidationController extends Controller
{
    public function validate(
        ValidateRequest $request,
        FileValidationService $fileValidationService,
        ValidationRequestBuilder $requestBuilder
    ): Response {
        $validationRequestDTO = $requestBuilder->build($request);

        $validationResult = $fileValidationService->validateFileRequest($validationRequestDTO);

        return response(
            content: [
                'data' => ValidationResultResource::make($validationResult),
            ],
            status: Response::HTTP_OK,
        );
    }
}
