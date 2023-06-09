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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('task_id')->autoIncrement();
            $table->unsignedBigInteger('trainee_id');
            $table->unsignedBigInteger('logbook_id');
            $table->unsignedInteger('work_order_no');
            $table->text('task_detail')->nullable();
            $table->string('category')->nullable();            
            $table->unsignedInteger('ATA')->nullable();
            $table->timestamp('TEE_SO')->nullable();
            $table->timestamp('INS_SO')->nullable();

            // Create foreign keys
            $table->foreign('logbook_id')->references('logbook_id')->on('logbooks');
            $table->foreign('trainee_id')->references('trainee_id')->on('trainees');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
