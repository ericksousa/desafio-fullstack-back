<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceInterface
{
    public function register(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return $this->makeResponse($user);
    }

    public function login(array $data)
    {
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = Auth::user();

            return $this->makeResponse($user);
        }

        throw new AuthenticationException('Unauthorised');
    }

    private function makeResponse(User $user): array
    {
        return [
            'token' => $user->createToken('APP')->plainTextToken,
            'user' => $user->only('id', 'name', 'email'),
        ];
    }
}
