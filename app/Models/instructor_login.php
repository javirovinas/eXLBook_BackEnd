<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instructor_login extends Model
{
    public static function createInstructor($data)
    {
        return Instructor_login::create($data);
    }

}
