<?php

declare(strict_types=1);

namespace App\Repositories\Builders\GoogleDns;

use App\DTO\GoogleDns\LookupResponseDTO;
use Arr;

class LookupDnsResponseBuilder
{
    public function build(array $data): LookupResponseDTO
    {
        return new LookupResponseDTO(
            status: $data['Status'],
            answers: Arr::map($data['Answer'] ?? [], function (array $answerData) {
                return $answerData['data'];
            }),
        );
    }
}
