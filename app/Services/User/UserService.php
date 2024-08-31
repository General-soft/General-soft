<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;
use App\Repositories\UserModelRepository;

class UserService
{
    public function __construct(
        private UserModelRepository $userRepository
    ) {
        //
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }
}
