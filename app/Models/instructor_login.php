<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class instructor_login extends Model
{
    protected $table = 'instructors';
    protected $fillable = ['username', 'password'];
    protected $hidden = ['password', 'api_token'];

    public $timestamps = false;

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
