<?php

declare(strict_types=1);

namespace App\Services\FileValidator;

use App\Repositories\GoogleDnsLookupRepository;

class ValidateIdentityProof
{
    public function __construct(
        GoogleDnsLookupRepository $dnsLookupRepository,
    ) {
        //
    }
}
