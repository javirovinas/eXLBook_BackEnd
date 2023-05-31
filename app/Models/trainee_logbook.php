<?php

namespace App\Models;

use App\Traits\Archivable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trainee_logbook extends Model
{
    use HasFactory;
    //use Archivable;


    protected $table = 'tasks';
    protected $fillable = ['work_order_no', 'task_detail', 'category', 'ATA', 'TEE_SO', 'INS_SO'];

    
    public function logbook()
    {
        return $this->belongsTo(Logbook::class);
    }
}
