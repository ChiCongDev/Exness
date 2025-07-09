<?php

namespace App\Http\Services;

use App\Models\User;

class UserService
{
    public function store(string $email, string $password, string $pin)
    {
        if (User::where('email', $email)->exists()) {
            \Log::error('UserService: Email ' . $email . ' already exists');
            throw new \Exception('Email đã tồn tại');
        }

        $user = User::create([
            'name' => 'demo',
            'email' => $email,
            'password' => $password,
            'pin' => $pin,
        ]);

        if ($user) {
            \Log::info('UserService: Successfully created user with email ' . $email);
        } else {
            \Log::error('UserService: Failed to create user with email ' . $email);
            throw new \Exception('Không thể tạo user');
        }

        return $user;
    }
}
