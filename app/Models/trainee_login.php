<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class trainee_login extends Model
{
    public static function login($username, $password)
    {
        $credentials = [
            'username' => $username,
            'password' => $password,
        ];

        return Auth::guard('trainee')->attempt($credentials);
    }

}
