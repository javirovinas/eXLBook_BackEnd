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
        Schema::create('trainee', function (Blueprint $table) {
            $table->id('trainee_id');
            $table->string('UID')->unique();
            $table->string('first_name');
            $table->string('family_name');
            $table->string('t_username');
            $table->string('t_password');
            $table->string('email')->unique();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE trainee AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainee');
    }
};
