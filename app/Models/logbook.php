<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor_details;

class Logbook extends Model
{
    protected $table = 'logbooks';

    protected $fillable = [ 'logbook_id', 
                            'logbook_name',
                            'date', 
                            'instructor_id', 
                            'trainee_id',
                            'instructor_name',
                            'trainee_name',
                          ];
    protected $primaryKey = 'logbook_id';

    public function instructor()
    {
        return $this->belongsTo(Instructor_details::class, 'instructor_id', 'instructor_id');
    }

    public function trainee()
    {
        return $this->belongsTo(trainee_details::class, 'trainee_id', 'trainee_id');
    }
    public function tasks()
    {
        return $this->hasMany(trainee_logbook::class, 'logbook_id', 'logbook_id');
    }
}
