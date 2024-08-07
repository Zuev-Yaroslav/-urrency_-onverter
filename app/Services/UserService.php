<?php

namespace App\Services;

use App\HttpClients\CurrencyHttpClient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function register($data) : User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }
}
