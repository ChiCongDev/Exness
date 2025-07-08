<?php

namespace App\Http\Services;

use App\Models\User;

class UserService
{
    public function store(string $email, string $password, string $pin) {
        return User::create([
            'name' => 'demo',
            'email' => $email,
            'password' => $password,
            'pin' => $pin,
        ]);
    }

}
