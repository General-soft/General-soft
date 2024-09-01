<?php

declare(strict_types=1);

namespace Tests\Feature\API\Token;

use Tests\Feature\ApiTestCase;

class GrantTokenTest extends ApiTestCase
{
    const API_ENDPOINT = '/api/tokens';

    public function testSuccessGrantToken(): void
    {
        $response = $this->post(self::API_ENDPOINT, [
            'email' => 'test@example.com',
            'password' => 'test',
            'grant_type' => 'password',
        ]);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'data' => [
                'token',
                'id',
                'user_id',
            ],
        ]);
    }

    public function testInvalidGrantToken(): void
    {
        $response = $this->post(self::API_ENDPOINT, [
            'email' => 'test@example.com',
            'password' => 'test2',
            'grant_type' => 'password',
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email',
            ],
        ]);
    }

    public function testNoGrantTypeToken(): void
    {
        $response = $this->post(self::API_ENDPOINT, [
            'email' => 'test@example.com',
            'password' => 'test',
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'grant_type',
            ],
        ]);
    }
}
