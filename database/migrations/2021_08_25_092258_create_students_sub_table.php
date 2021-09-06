<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_sub', function (Blueprint $table) {
            $table->unsignedInteger('id_student');
            $table->unsignedInteger('id_subject');

            $table->foreign('id_student')->references('id')->on('students')->onDelete('cascade');
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
        Schema::dropIfExists('students_sub');
    }
}
