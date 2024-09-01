<?php

declare(strict_types=1);

namespace App\Services\Auth\Authenticator;

use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidatorInstance;

class PasswordAuthenticator implements Authenticator
{
    public function __construct(
        private UserService $userService,
    ) {
        //
    }

    public function authenticate(array $data): ?User
    {
        $email = $data['email'] ?? null;

        $user = $this->userService->getUserByEmail($email);

        $this->validateUser($user, $data);

        return $user;
    }

    private function validateUser(?User $user, array $data): void
    {
        $password = $data['password'] ?? null;

        $validator = Validator::make($data, [
            'email' => [
                'required',
            ],
            'password' => [
                'required',
            ],
        ]);

        $validator->after(static function (ValidatorInstance $validator) use ($user, $password) {
            if (is_null($user) || ! (Hash::check($password, $user->password))) {
                $validator->errors()->add(
                    'email',
                    'Invalid login or password.',
                );
            }
        });

        if ($validator->fails()) {
            $exception = $validator->getException();

            throw (new $exception($validator));
        }
    }
}
