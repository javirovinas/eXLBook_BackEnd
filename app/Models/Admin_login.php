<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Trainee_details;

class Admin_login extends Authenticatable
{
    // Define the table name if different from 'admin_login'
    protected $table = 'admin_login';
    
    // Define the fillable fields
    protected $fillable = ['username', 'password', 'api_token'];

    // Exclude the timestamps for this model
    public $timestamps = false;

    public function createTrainee($data)
    {
        return trainee_details::createTrainee($data);
    }

    public function createInstructor($data)
    {
        return Instructor_details::createInstructor($data);
    }
}

