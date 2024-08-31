<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Resources\TokenResource;
use App\Services\AuthTokenService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Passport\Token;

class TokenController extends Controller
{
    public function __construct(
        readonly private AuthTokenService $authTokenService,
    ) {

    }

    public function store(Request $request): Response
    {
        $userToken = $this->authTokenService->create($request->user(), 'api');

        return response(
            content: [
                'data' => TokenResource::make($userToken),
            ],
            status: Response::HTTP_CREATED,
        );
    }
}
