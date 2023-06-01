<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor_details;

class logbook extends Model
{
    protected $fillable = [ 'logbook_id', 
                            'logbook_name', 
                            'instructor_id', 
                            'trainee_id'
                          ];
    protected $primaryKey = 'logbook_id';

    public function instructor()
    {
        return $this->belongsTo(Instructor_details::class, 'instructor_id');
    }

    public function trainee()
    {
        return $this->belongsTo(Trainee_details::class, 'trainee_id');
    }
}
