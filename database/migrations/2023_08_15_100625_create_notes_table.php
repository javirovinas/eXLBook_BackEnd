<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id('notes_id')->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');
            $table->enum('role', ['trainee', 'instructor']);
            $table->text('content');
            $table->timestamps();

            $table->foreign('user_id')->references('trainee_id')->on('trainees');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notes');
    }
};
