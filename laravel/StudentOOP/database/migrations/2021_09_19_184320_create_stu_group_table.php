<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStuGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stu_group', function (Blueprint $table) {
            $table->foreignId('group_id',)->constrained()->references('id')->on('groups')->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->references('id')->on('students')->onDelete('cascade');
            $table->foreign('semester')->references('semester')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stu_group');
    }
}