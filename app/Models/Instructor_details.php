<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor_details extends Model
{
    protected $table = 'instructor_details';

    protected $fillable = [
        'instructor_id',
        'UID',
        'first_name',
        'family_name',
        'i_username',
        'i_password',
        'email',
    ];
}
