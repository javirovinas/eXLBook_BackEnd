<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class trainee_details extends Authenticatable
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
    public function isTrainee()
    {
        return session()->has('trainee_logged_in');
    }
    
public function logbook()
{
    return $this->hasOne(logbook::class, 'trainee_id');
}
}

