<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyllabusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syllabi', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('grade_first_sem');
            $table->string('grade_second_sem');
            $table->string('class_description');
            $table->string('year_level');
            $table->string('section');
            $table->string('student_count');
            $table->string('room_no');
            $table->string('building_no');
            $table->longText('pdf_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('syllabus');
    }
}
