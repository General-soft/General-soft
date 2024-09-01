<?php

declare(strict_types=1);

namespace Tests\Feature\API;

use App\Enums\FileValidationResult;
use App\Enums\Issuer;
use App\Models\User;
use App\Services\FileValidator\IdentityValidation\IdentityFailValidator;
use App\Services\FileValidator\IdentityValidation\IdentitySuccessValidator;
use App\Services\FileValidator\IdentityValidation\IdentityValidator;
use App\Services\User\UserService;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Tests\Feature\ApiTestCase;

class FileValidationTest extends ApiTestCase
{
    const VALIDATION_ROUTE = '/api/validations';

    private User $authUser;

    protected function setUp(): void
    {
        parent::setUp();

        $userService = $this->app->make(UserService::class);

        $this->authUser = $userService->getUserByEmail('test@example.com');

        $this->app->bind(IdentityValidator::class, IdentitySuccessValidator::class);

        $this->authenticateAs($this->authUser);
    }

    public function testSuccessValidation(): void
    {
        $data = $this->jsonData();

        $response = $this->post(self::VALIDATION_ROUTE, [
            'file' => UploadedFile::fake()->createWithContent('test.json', json_encode($data)),
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'data' => [
                'issuer' => Issuer::Accredify->value,
                'result' => FileValidationResult::Verified->value,
            ],
        ]);
    }

    public function testInvalidRecipient(): void
    {
        $data = $this->jsonData();
        $data['data']['recipient'] = [];

        $response = $this->post(self::VALIDATION_ROUTE, [
            'file' => UploadedFile::fake()->createWithContent('test.json', json_encode($data)),
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'data' => [
                'issuer' => Issuer::Accredify->value,
                'result' => FileValidationResult::InvalidRecipient->value,
            ],
        ]);
    }

    public function testInvalidIssuer(): void
    {
        $data = $this->jsonData();
        $data['data']['issuer']['identityProof']['key'] = '';

        $response = $this->post(self::VALIDATION_ROUTE, [
            'file' => UploadedFile::fake()->createWithContent('test.json', json_encode($data)),
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'data' => [
                'issuer' => Issuer::Accredify->value,
                'result' => FileValidationResult::InvalidIssuer->value,
            ],
        ]);
    }

    public function testInvalidIssuerProof(): void
    {
        $data = $this->jsonData();

        $this->app->bind(IdentityValidator::class, IdentityFailValidator::class);

        $response = $this->post(self::VALIDATION_ROUTE, [
            'file' => UploadedFile::fake()->createWithContent('test.json', json_encode($data)),
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'data' => [
                'issuer' => Issuer::Accredify->value,
                'result' => FileValidationResult::InvalidIssuer->value,
            ],
        ]);
    }

    public function testInvalidHash(): void
    {
        $data = $this->jsonData();
        $data['signature']['targetHash'] = '123';

        $response = $this->post(self::VALIDATION_ROUTE, [
            'file' => UploadedFile::fake()->createWithContent('test.json', json_encode($data)),
        ]);

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJson([
            'data' => [
                'issuer' => Issuer::Accredify->value,
                'result' => FileValidationResult::InvalidSignature->value,
            ],
        ]);
    }

    public function testFailEmptyFile(): void
    {
        $response = $this->post(self::VALIDATION_ROUTE, [
            'file' => UploadedFile::fake()->createWithContent('test.json', json_encode([])),
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testFailInvalidFile(): void
    {
        $response = $this->post(self::VALIDATION_ROUTE);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    private function jsonData()
    {
        return [
            'data' => [
                'id' => '63c79bd9303530645d1cca00',
                'name' => 'Certificate of Completion',
                'recipient' => [
                    'name' => 'Marty McFly',
                    'email' => 'marty.mcfly@gmail.com',
                ],
                'issuer' => [
                    'name' => 'Accredify',
                    'identityProof' => [
                        'type' => 'DNS-DID',
                        'key' => 'did:ethr:0x05b642ff12a4ae545357d82ba4f786f3aed84214#controller',
                        'location' => 'ropstore.accredify.io',
                    ],
                ],
                'issued' => '2022-12-23T00:00:00+08:00',
            ],
            'signature' => [
                'type' => 'SHA3MerkleProof',
                'targetHash' => '288f94aadadf486cfdad84b9f4305f7d51eac62db18376d48180cc1dd2047a0e',
            ],
        ];
    }
}
