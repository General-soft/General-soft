<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes\Info;
use OpenApi\Attributes\SecurityScheme;

#[Info(
    version: '1.0.0',
    title: 'Validation service',
)]
#[SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    name: 'bearerAuth',
    in: 'header',
    bearerFormat: 'JWT',
    scheme: 'bearer'
)]
class BaseApiController extends Controller
{
    /**
     * @param  array|JsonResource  $data
     */
    protected function jsonResponse($data, int $status): JsonResponse
    {
        return new JsonResponse([
            'data' => $data,
        ], $status);
    }
}
