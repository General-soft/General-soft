<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Passport\PersonalAccessTokenResult;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

/**
 * @mixin PersonalAccessTokenResult
 */
#[Schema(
    schema: 'TokenResource',
    required: ['token', 'id', 'user_id'],
    properties: [
        new Property(
            property: 'token',
            description: 'Token that should be provided as bearer token in authorization header. Authorization: Bearer {token}',
            type: 'string',
            example: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiMGEwMmUwNTgyNWRjZjQzZGZiMGNkMTZhZTRlZDBiYTM3MzViN2Y3MmVlMjEzOGEzYTU3ZGNmOTNhNzQ4M2JmOGZkYjk4ODE5ZDZmYzQyODciLCJpYXQiOjE3MjUxOTk0OTIuMjI0MTI5LCJuYmYiOjE3MjUxOTk0OTIuMjI0MTMxLCJleHAiOjE3NTY3MzU0OTIuMjA4MDMxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Q0UqGJjMtuxlpKCzaIofOIFaeEQ9uhvQt0eTv3dUdftcRKrd3Ibd4dpJoJBigzxK01twnEyGSLOx_pJI8unq06lS-KKzqsCEe77q2_JOuO8NEfEPsUVBkDTsTgZ538xRfVWns5fANHYSct9uDFNdeHz3n1Eo4K1a2ioQPPH8SzVzqsZyqRESy6-XYODRx4B08gKH5F4yGhYaqs5LXXJFB0tw2MyQPgQ0SXOo2ysx4wmMKwqOowOi9FdjCPnLaXK4gw3QhwndFyE99oRaygxhopk800TFxsxT9NUrM7TdJLfdatrHJZIEaeqCo4vCQkOXwr7avEzr6cL0lyHncq4tuJAl74cKwjUddm6WNndZbu7QfRw2D65vEVjx5Q6710GzkSWvTo1kDscCuxnVoSwdAlAGkgKLfShWIPiD9wsdcVv0_ux56ELrjU7SJ8QoaTXCa4yWvJmgq-q9XEvVEGV1bwlCwZavUjkSkZBIQDbBNeygLTx6lwYj4H3H-7xGkw_FjhBarb2cuqewRglRrfVtm5DunRBXgT62L0sYkEPuqGjwoddEADwOqPDFZxOqCkHvtt9OZgpeOsenvWCgS0KnrF0jfCBW65BJpUafXoSS41u6n5Bq86o4GQLFR1YL2z48Y-r3LhAm6Bs59XnON3Hi8OrtcpUd12PUTAu9qfuFNX0',
        ),
        new Property(
            property: 'id',
            type: 'string',
            example: '0a02e05825dcf43dfb0cd16ae4ed0ba3735b7f72ee2138a3a57dcf93a7483bf8fdb98819d6fc4287',
        ),
        new Property(
            property: 'user_id',
            type: 'integer',
            example: 1,
        ),
    ],
)]
class TokenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->accessToken,
            'id' => $this->token->id,
            'user_id' => $this->token->user->id,
        ];
    }
}
