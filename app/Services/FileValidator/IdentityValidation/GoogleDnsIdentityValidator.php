<?php

declare(strict_types=1);

namespace App\Services\FileValidator\IdentityValidation;

use App\Enums\GoogleDnsLookup\LookupResponseStatus;
use App\Enums\GoogleDnsLookup\RecordType;
use App\Repositories\GoogleDnsLookupRepository;

class GoogleDnsIdentityValidator implements IdentityValidator
{
    public function __construct(
        private GoogleDnsLookupRepository $googleDnsLookupRepository,
    ) {
        //
    }

    public function validateIdentity(string $domain, string $key): bool
    {
        $lookupResponse = $this->googleDnsLookupRepository->resolve($domain, RecordType::TXT);

        if ($lookupResponse->getStatus() !== LookupResponseStatus::Success->value) {
            return false;
        }

        foreach ($lookupResponse->getAnswers() as $answer) {
            if (preg_match(sprintf('/(p=%1$s;)|(p=%1$s$)/', preg_quote($key)), $answer)) {
                return true;
            }
        }

        return false;
    }
}
