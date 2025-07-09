<?php

namespace App\Http\Services;

use App\Models\User;

class UserService
{
    public function store(string $email, string $password, string $pin)
    {
        // Kiểm tra trùng lặp email
        if (User::where('email', $email)->exists()) {
            throw new \Exception('Email đã tồn tại');
        }

        return User::create([
            'name' => 'demo',
            'email' => $email,
            'password' => $password, // Giữ nguyên plain text theo yêu cầu
            'pin' => $pin,
        ]);
    }
}
