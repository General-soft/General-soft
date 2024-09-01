<?php

declare(strict_types=1);

namespace App\Extensions\OpenApi\Attributes\Responses;

use Attribute;
use Illuminate\Http\Response;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response as OpenApiResponse;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class HttpUnprocessableEntityResponse extends OpenApiResponse
{
    public function __construct()
    {
        parent::__construct(
            response: Response::HTTP_UNPROCESSABLE_ENTITY,
            description: 'Unprocessable entity',
            content: new JsonContent(
                properties: [
                    new Property(property: 'message', type: 'string'),
                    new Property(property: 'errors', type: 'object'),
                ],
            ),
        );
    }
}
