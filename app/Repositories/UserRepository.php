<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

/**
 * @extends BaseModelRepository<User>
 */
class UserRepository extends BaseModelRepository
{
    protected string $model = User::class;

    public function findByEmail(string $email): ?User
    {
        return $this->query()->where('email', '=', $email)->first();
    }
}
