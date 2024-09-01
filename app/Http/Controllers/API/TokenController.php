<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Extensions\OpenApi\Attributes\Responses\HttpCreatedResponse;
use App\Extensions\OpenApi\Attributes\Responses\HttpUnprocessableEntityResponse;
use App\Http\Requests\Auth\AuthenticateUserRequest;
use App\Http\Resources\TokenResource;
use App\Services\Auth\AuthTokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;

class TokenController extends BaseApiController
{
    public function __construct(
        readonly private AuthTokenService $authTokenService,
    ) {
        //
    }

    #[Post(
        path: '/api/tokens',
        description: 'Create API token by login and password',
        summary: 'Create API token',
        requestBody: new RequestBody(
            required: true,
            content: new JsonContent(
                ref: '#/components/schemas/AuthenticateUserByPasswordRequest',
            ),
        ),
        tags: [
            'Auth',
        ],
        parameters: [],
        responses: [
            new HttpCreatedResponse(
                content: new JsonContent(
                    properties: [
                        new Property(
                            property: 'data',
                            ref: '#/components/schemas/TokenResource',
                            type: 'object',
                        ),
                    ],
                ),
            ),
            new HttpUnprocessableEntityResponse,
        ],
    )]
    public function store(AuthenticateUserRequest $request): JsonResponse
    {
        $userToken = $this->authTokenService->createToken($request->user(), 'api');

        return $this->jsonResponse(
            data: TokenResource::make($userToken),
            status: Response::HTTP_CREATED,
        );
    }
}
