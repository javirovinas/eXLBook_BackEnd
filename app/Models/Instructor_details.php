<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\logbook;

class Instructor_details extends Model
{
    protected $table = 'instructors';

    protected $fillable = [
        'instructor_id',
        'UID',
        'first_name',
        'family_name',
        'i_username',
        'i_password',
        'email',
    ];

    protected $primaryKey = 'instructor_id';

    public function logbook()
    {
        return $this->hasMany(Logbook::class, 'instructor_id');
    }
}
