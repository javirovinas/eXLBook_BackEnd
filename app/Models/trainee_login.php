<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Trainee_login extends Model
{
    protected $table = 'trainees';
    protected $fillable = ['username', 'password'];

    public $timestamps = false;
    protected $hidden = ['password', 'api_token'];

    public function setpasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}