<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id('logbook_id');
            $table->string('logbook_name');
            $table->unsignedBigInteger('trainee_id');
            $table->unsignedBigInteger('instructor_id');
            
            // Foreign keys
            $table->foreign('trainee_id')->references('trainee_id')->on('trainees')->onDelete('cascade');
            $table->foreign('instructor_id')->references('instructor_id')->on('instructors')->onDelete('cascade');
            
            $table->timestamps();

            //$table->foreign('instructor_id')->references('instructor_id')->on('instructor_details')->onDelete('cascade');
            //$table->foreign('trainee_id')->references('trainee_id')->on('trainee_details')->onDelete('cascade');
       
        });
        DB::statement('ALTER TABLE logbooks AUTO_INCREMENT = 10000;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};
