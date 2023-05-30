<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Admin_login extends Authenticatable
{
    // Define the table name if different from 'admin_login'
    protected $table = 'admin_login';
    protected $fillable = ['username', 'password', 'api_token'];
    public $timestamps = false;
    protected $hidden = 'password';

    
  /*  public static function login($username, $password)
    {
        $admin = self::where('username', $username)->first();

        if ($admin && Hash::check($password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return true;
        }

        return false;
    } */

    public function createTrainee($data)
    {
        return Trainee_details::createTrainee($data);
    }

    public function createInstructor($data)
    {
        return Instructor_details::createInstructor($data);
    }
}