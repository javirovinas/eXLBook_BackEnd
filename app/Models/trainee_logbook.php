<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trainee_logbook extends Model
{
    use HasFactory;


    protected $table = 'tasks';
    protected $fillable = ['trainee_id', 'logbook_id', 'work_order_no', 'task_detail', 'category', 'ATA', 'TEE_SO', 'INS_SO'];
    public function logbook()
    {
        return $this->belongsTo(Logbook::class);
    }

    public function logbookEntries()
    {
    return $this->hasMany(trainee_logbook::class);
    }

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }
}