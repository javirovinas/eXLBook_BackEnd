<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\Hash;
use App\Model\trainee_details;


class Trainee_login extends Model
{
    protected $table = 'trainees';
    protected $fillable = ['username', 'password'];

    public $timestamps = false;
    protected $hidden = ['password', 'api_token'];

    public static function login($username, $password)
    {
        $trainee = self::where('t_username', $username)->first();

        if ($trainee && Hash::check($password, $trainee->t_password)) {
            Auth::guard('trainee')->login($trainee);
            return true;
        }

        return false;
    }

}
