<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trainee_login extends Model
{
    public static function createTrainee($data)
    {
        return Trainee_login::create($data);
    }

}