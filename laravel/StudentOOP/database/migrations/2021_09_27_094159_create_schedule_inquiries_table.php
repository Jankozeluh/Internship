<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->string('pc')->nullable();
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
        Schema::dropIfExists('schedule_inquiries');
    }
}