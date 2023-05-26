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
        Schema::create('instructor_logbook_accesses', function (Blueprint $table) {
            $table->id('instructor_id');
            $table->string('logbook_id');
            $table->string('UID')->unique();
            $table->string('log_name');
            $table->string('i_username');
            $table->string('i_password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_logbook_accesses');
    }
};
