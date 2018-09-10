<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortCourseStudSiblingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_course_stud_siblings', function (Blueprint $table) {
            $table->increments('sib_id');
            $table->integer('scstud_id')->unsigned();
            $table->integer('scs_id')->unsigned();
            $table->timestamps();

            $table->foreign('scstud_id')
                  ->references('scstud_id')
                  ->on('short_course_student_sib')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

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
        Schema::drop('short_course_stud_siblings');
    }
}
