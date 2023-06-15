<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Trainee_details extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'trainees';

    protected $fillable = [
        'trainee_id',
        'uid',
        'first_name',
        'family_name',
        't_username',
        't_password',
        'email',
        'api_token', // Include 'api_token' in the fillable array
    ];

    protected $primaryKey = 'trainee_id';
}
