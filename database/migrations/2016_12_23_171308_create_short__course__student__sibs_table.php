<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortCourseStudentSibsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_course_student_sib', function (Blueprint $table) {
            $table->increments('scstud_id');
            $table->integer('scs_id')->unsigned();
            $table->timestamps();

            $table->foreign('scs_id')
                  ->references('scs_id')
                  ->on('short_course_student')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('short_course_student_sib');
    }
}
