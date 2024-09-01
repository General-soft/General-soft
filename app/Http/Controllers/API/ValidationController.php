<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Extensions\OpenApi\Attributes\Responses\HttpOkResponse;
use App\Extensions\OpenApi\Attributes\Responses\HttpUnauthorizedResponse;
use App\Extensions\OpenApi\Attributes\Responses\HttpUnprocessableEntityResponse;
use App\Facades\FileValidator\FileValidator;
use App\Http\Builders\FileValidation\ValidationRequestBuilder;
use App\Http\Requests\FileValidation\ValidateRequest;
use App\Http\Resources\FileValidation\ValidationResultResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Schema;

class ValidationController extends BaseApiController
{
    #[Post(
        path: '/api/validations',
        description: 'Validate json file issued by accredify',
        summary: 'Validate file',
        security: [
            'bearerAuth' => [],
        ],
        requestBody: new RequestBody(
            required: true,
            content: new MediaType(
                mediaType: 'multipart/form-data',
                schema: new Schema(ref: '#/components/schemas/ValidateRequest'),
            ),
        ),
        tags: [
            'Validation',
        ],
        parameters: [],
        responses: [
            new HttpOkResponse(
                content: new JsonContent(
                    properties: [
                        new Property(
                            property: 'data',
                            ref: '#/components/schemas/ValidationResultResource',
                            type: 'object',
                        ),
                    ],
                ),
            ),
            new HttpUnprocessableEntityResponse,
            new HttpUnauthorizedResponse,
        ],
    )]
    public function store(
        ValidateRequest $request,
        FileValidator $fileValidator,
        ValidationRequestBuilder $requestBuilder
    ): JsonResponse {
        $validationRequestDTO = $requestBuilder->build($request);

        $validationResult = $fileValidator->validate($request->user(), $validationRequestDTO);

        return $this->jsonResponse(
            data: ValidationResultResource::make($validationResult),
            status: Response::HTTP_OK,
        );
    }
}
