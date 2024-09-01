<?php

declare(strict_types=1);

namespace Tests\Feature\Services\FileValidator\IdentityValidation;

use App\Services\FileValidator\IdentityValidation\GoogleDnsIdentityValidator;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Feature\TestCase;

class GoogleDnsIdentityValidatorTest extends TestCase
{
    const KEY = 'did:ethr:0x05b642ff12a4ae545357d82ba4f786f3aed84214#controller';

    const DOMAIN = 'ropstore.accredify.io';

    public function testInvalidStatus()
    {
        Http::fake(fn () => [
            'Status' => 1,
        ]);

        $validator = $this->app->make(GoogleDnsIdentityValidator::class);

        $this->assertFalse($validator->validateIdentity(self::DOMAIN, self::KEY));
    }

    public static function recorsdProvider(): array
    {
        return [
            [
                true, 'openatts a=dns-did; p=did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45#controller; v=1.0;', 'did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45#controller',
            ],
            [
                true, 'openatts a=dns-did; p=did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45#controller;', 'did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45#controller',
            ],
            [
                true, 'openatts a=dns-did; p=did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45#controller', 'did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45#controller',
            ],
            [
                false, 'openatts a=dns-did; p=did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45#controllercontroller; v=1.0;', 'did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45#controller',
            ],
            [
                false, 'openatts a=dns-did; p=did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45#controllercontroller;', 'did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45#controller',
            ],
            [
                false, 'openatts a=dns-did; p=did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45#controllercontroller', 'did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45#controller',
            ],
            [
                false, 'openatts a=dns-did; p=did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45', 'did:ethr:0x757cd434dd1e93d47a4c6ed7a1b31bd88d984b45#controller',
            ],
        ];
    }

    #[DataProvider('recorsdProvider')]
    public function testRecordResults(bool $expectedResult, string $dnsRecordData, string $key): void
    {
        Http::fake(fn () => [
            'Status' => 0,
            'Answer' => [
                [
                    'data' => $dnsRecordData,
                ],
            ],
        ]);

        $validator = $this->app->make(GoogleDnsIdentityValidator::class);

        $this->assertEquals($expectedResult, $validator->validateIdentity(self::DOMAIN, $key));
    }
}
