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
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id('logbook_id')->autoIncrement();
            $table->string('logbook_name');
            $table->date('date')->nullable();
            $table->unsignedBigInteger('trainee_id');
            $table->unsignedBigInteger('instructor_id');
            $table->string('instructor_name')->nullable(); // Add instructor name column
            $table->string('trainee_name')->nullable(); // Add trainee name column
            $table->boolean('archived')->default(false);
            
            // Foreign keys
            $table->foreign('trainee_id')->references('trainee_id')->on('trainees')->onDelete('cascade');
            $table->foreign('instructor_id')->references('instructor_id')->on('instructors')->onDelete('cascade');
            
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};
