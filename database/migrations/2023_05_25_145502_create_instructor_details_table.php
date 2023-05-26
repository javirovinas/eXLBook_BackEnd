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
        Schema::create('instructor_details', function (Blueprint $table) {
            $table->id('instructor_id');
            $table->string('UID')->unique();
            $table->string('first_name');
            $table->string('family_name');
            $table->string('i_username');
            $table->string('i_password');
            $table->string('email')->unique();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE instructor_details AUTO_INCREMENT = 100;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_details');
    }
};
