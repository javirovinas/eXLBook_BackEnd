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
            $table->unsignedBigInteger('logbook_id');
            $table->unsignedInteger('work_order_no');
            $table->string('log_name');
            $table->text('task_detail')->nullable();
            $table->string('category')->nullable();            
            $table->string('ATA')->nullable();
            $table->timestamp('TEE_SO')->nullable();
            $table->timestamp('INS_SO')->nullable();
            $table->boolean('archived')->default(false);
            $table->timestamps();

            // Set composite primary key
            $table->primary(['logbook_id', 'work_order_no']);

            //Set foreign key
            $table->foreign('logbook_id')->references('logbook_id')->on('logbooks')->onDelete('cascade');
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
