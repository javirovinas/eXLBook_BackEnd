<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trainee_logbooks', function (Blueprint $table) {
            $table->id('logbook_id');
            $table->string('log_name');
            $table->string('work_order_no');
            $table->text('task_detail')->nullable();
            $table->string('category')->nullable();
            $table->string('ATA')->nullable();
            $table->enum('TEE_SO', ['yes', 'no'])->default('no');
            $table->timestamp('student_signed_off_at')->nullable();
            $table->enum('INS_SO', ['yes', 'no'])->default('no');
            $table->timestamp('instructor_signed_off_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainee_logbooks');
    }
};
