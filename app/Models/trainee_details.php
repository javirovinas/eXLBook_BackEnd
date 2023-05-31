<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Trainee_details extends Model
{
    protected $table = 'trainees';

    protected $fillable = [
        'trainee_id',
        'UID',
        'first_name',
        'family_name',
        't_username',
        't_password',
        'email',
    ];

    protected $primaryKey = 'trainee_id';


    public function logbook()
    {
        return $this->hasOne(Logbook::class, 'trainee_id');
    }
}
