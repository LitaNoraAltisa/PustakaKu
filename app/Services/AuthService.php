<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\facades\Hash;

class AuthService
{
    public function register(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'member',
        ]);
    }

    public function login(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    public function logout()
    {
        Auth::logout();
    }
}