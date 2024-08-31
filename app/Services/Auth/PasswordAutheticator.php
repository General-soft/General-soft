<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordAutheticator implements Autheticator
{
    public function autheticate(array $data): ?User
    {
        $email = $data['email'] ?? null;

        /** @var ?User $user */
        $user = User::where('email', '=', $email)->first();

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

        $validator->after(static function (\Illuminate\Validation\Validator $validator) use ($user, $data, $password) {
            if (is_null($user) || !(Hash::check($password, $user->password))) {
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
