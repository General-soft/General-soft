<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateUserRequest;
use App\Http\Resources\TokenResource;
use App\Services\Auth\AuthTokenService;
use Illuminate\Http\Response;

class TokenController extends Controller
{
    public function __construct(
        readonly private AuthTokenService $authTokenService,
    ) {
        //
    }

    public function store(AuthenticateUserRequest $request): Response
    {
        $userToken = $this->authTokenService->createToken($request->user(), 'api');

        return response(
            content: [
                'data' => TokenResource::make($userToken),
            ],
            status: Response::HTTP_CREATED,
        );
    }
}
