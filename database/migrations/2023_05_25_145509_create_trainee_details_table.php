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
        Schema::create('trainees', function (Blueprint $table) {
            $table->id('trainee_id')->autoIncrement();
            $table->unsignedInteger('UID')->unique()->digits(6);
            $table->string('first_name');
            $table->string('family_name');
            $table->string('t_username')->unique();
            $table->string('t_password');
            $table->string('email')->unique();
            $table->string('api_token', 80)->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainees');
    }
};
