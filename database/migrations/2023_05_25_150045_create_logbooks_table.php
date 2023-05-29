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
            $table->id('logbook_id');
            $table->string('log_name');
            $table->string('trainee_id');
            $table->string('instructor_id');
            $table->timestamps();

            $table->foreign('instructor_id')->references('instructor_id')->on('instructor_details')->onDelete('cascade');
            $table->foreign('trainee_id')->references('trainee_id')->on('trainee_details')->onDelete('cascade');
       
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
