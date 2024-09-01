<?php

declare(strict_types=1);

namespace App\Extensions\OpenApi\Attributes\Responses;

use Attribute;
use Illuminate\Http\Response;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Response as OpenApiResponse;

/**
 * @codeCoverageIgnore
 */
#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class HttpUnauthorizedResponse extends OpenApiResponse
{
    public function __construct()
    {
        parent::__construct(
            response: Response::HTTP_UNAUTHORIZED,
            description: 'Unauthorized',
            content: new JsonContent(
                example: [
                    'message' => 'Unauthorized',
                ],
            ),
        );
    }
}
