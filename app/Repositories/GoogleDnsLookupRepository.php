<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\GoogleDns\LookupResponseDTO;
use App\Enums\GoogleDnsLookup\RecordType;
use App\Repositories\Builders\GoogleDns\LookupDnsResponseBuilder;
use Illuminate\Http\Client\PendingRequest;

class GoogleDnsLookupRepository
{
    public function __construct(
        private PendingRequest $pendingRequest,
        private LookupDnsResponseBuilder $lookupDnsResponseBuilder,
    ) {
        //
    }

    public function resolve(string $name, RecordType $recordType): LookupResponseDTO
    {
        $response = $this->pendingRequest->get('/resolve', [
            'name' => $name,
            'type' => $recordType->value,
        ]);

        return $this->lookupDnsResponseBuilder->build($response->json());
    }
}
