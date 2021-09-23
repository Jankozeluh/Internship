<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pc');
            $table->string('date');
            $table->foreignId('subject_id')->constrained()->references('id')->on('subjects')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained()->references('id')->on('teachers')->onDelete('cascade');
            $table->foreignId('group_id')->constrained()->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercises');
    }
}
