<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers_sub', function (Blueprint $table) {
            $table->unsignedInteger('id_teacher');
            $table->unsignedInteger('id_subject');
            $table->integer('lecture');
            $table->integer('exercise');

            $table->foreign('id_teacher')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('id_subject')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers_sub');
    }
}
