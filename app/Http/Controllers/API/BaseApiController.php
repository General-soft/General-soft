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
    description: 'Service to validate json files. <br><br> To access validation part first get bearer token using <strong>post /api/token</strong> endpoint. Token can be accessible from response using <strong>data.token</strong> path. <br> Use this token for bearer authorization using header <strong>Authorization: Bearer {token}</strong>. <br> With authorization header token set send request to file validation endpoint <strong>post /api/validations</strong>. Example file for validation stored in the root of the project <strong>json.json</strong>.',
    title: 'Validation service'
)]
#[SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    name: 'bearerAuth',
    in: 'header',
    bearerFormat: 'JWT',
    scheme: 'bearer'
)]
abstract class BaseApiController extends Controller
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
