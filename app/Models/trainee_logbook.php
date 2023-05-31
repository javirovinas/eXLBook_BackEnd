<?php

namespace App\Models;

use App\Traits\Archivable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trainee_logbook extends Model
{
    use HasFactory;
    //use Archivable;
<<<<<<< HEAD


    protected $table = 'tasks';
    protected $fillable = ['work_order_no', 'task_detail', 'category', 'ATA', 'TEE_SO', 'INS_SO'];
=======
    protected $table = 'tasks';
    protected $fillable = ['log_name', 'work_order_no', 'task_detail', 'category', 'ATA', 'TEE_SO', 'INS_SO'];
>>>>>>> 730041130be9d7016e58c0e0a375cee1335757fa

    
    public function logbook()
    {
        return $this->belongsTo(Logbook::class);
    }
}
