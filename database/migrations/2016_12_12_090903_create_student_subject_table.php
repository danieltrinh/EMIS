<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subject', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('grade_id')->unsigned();
            $table->integer('subject_id')->unsigned();

            $table->integer('s1_quizzes')->unsigned();
            $table->integer('s1_midterm')->unsigned();
            $table->integer('s1_final')->unsigned();
            $table->integer('s1_total')->unsigned();

            $table->integer('s2_quizzes')->unsigned();
            $table->integer('s2_midterm')->unsigned();
            $table->integer('s2_final')->unsigned();
            $table->integer('s2_total')->unsigned();

            $table->integer('year_final')->unsigned();

            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('student_subject');
    }
}
