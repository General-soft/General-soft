<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class UserModelRepository extends BaseModelRepository
{
    protected $model = User::class;

    public function findByEmail(string $email): ?User
    {
        return $this->query()->where('email', '=', $email)->first();
    }
}
