<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Admin_login extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'admin_login';
    protected $fillable = ['username', 'password', 'api_token'];
    public $timestamps = false;
    protected $hidden = ['password'];

    public function isAdmin()
    {
        return session()->has('admin_logged_in');
    }

    public function createTrainee($data)
    {
        return Trainee_details::createTrainee($data);
    }

    public function createInstructor($data)
    {
        return Instructor_details::createInstructor($data);
    }
}