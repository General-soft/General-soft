<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Facades\FileValidator\FileValidator;
use App\Http\Builders\FileValidation\ValidationRequestBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileValidation\ValidateRequest;
use App\Http\Resources\FileValidation\ValidationResultResource;
use Illuminate\Http\Response;

class ValidationController extends Controller
{
    public function validate(
        ValidateRequest $request,
        FileValidator $fileValidator,
        ValidationRequestBuilder $requestBuilder
    ): Response {
        $validationRequestDTO = $requestBuilder->build($request);

        $validationResult = $fileValidator->validate($request->user(), $validationRequestDTO);

        return response(
            content: [
                'data' => ValidationResultResource::make($validationResult),
            ],
            status: Response::HTTP_OK,
        );
    }
}
