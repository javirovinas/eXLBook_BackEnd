<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Instructor_details extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'instructors';

    protected $fillable = [
        'instructor_id',
        'uid',
        'first_name',
        'family_name',
        'i_username',
        'i_password',
        'email',
        'api_token', // Include 'api_token' in the fillable array
    ];

    protected $primaryKey = 'instructor_id';
    public function isInstructor()
    {
        return session()->has('instructor_logged_in');
    }
}
