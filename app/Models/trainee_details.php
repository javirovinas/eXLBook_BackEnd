<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Trainee_details extends Model
{
    protected $table = 'trainee_details';

    protected $fillable = [
        'trainee_id',
        'uid',
        'first_name',
        'family_name',
        'username',
        'password',
        'email',
    ];

    // Additional model logic, relationships, and methods can be defined here
}
