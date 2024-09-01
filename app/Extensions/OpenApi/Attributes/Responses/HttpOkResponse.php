<?php

declare(strict_types=1);

namespace App\Extensions\OpenApi\Attributes\Responses;

use Attribute;
use Illuminate\Http\Response;
use OpenApi\Attributes\Attachable;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\Response as OpenApiResponse;
use OpenApi\Attributes\XmlContent;

/**
 * @codeCoverageIgnore
 */
#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class HttpOkResponse extends OpenApiResponse
{
    public function __construct(
        MediaType|JsonContent|XmlContent|Attachable|array|null $content = null,
    ) {
        parent::__construct(
            response: Response::HTTP_OK,
            description: 'Success',
            content: $content,
        );
    }
}
