<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $table = 'notes';
    protected $fillable = [
        'user_id', 
        'task_id', 
        'role', 
        'content'
    ];
    
    protected $primaryKey = 'notes_id';
    public function task()
    {
        return $this->belongsTo(trainee_logbook::class, 'task_id');
    }
    public function instrucotr()
    {
        return $this->belongsTo(Instructor_logbook_access::class, 'task_id');
    }
}


