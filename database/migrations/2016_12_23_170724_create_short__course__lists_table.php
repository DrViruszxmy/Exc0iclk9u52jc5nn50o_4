<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortCourseListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_course_list', function (Blueprint $table) {
            $table->increments('scl_id');
            $table->integer('ssi_id')->unsigned();
            $table->string('sc_code');
            $table->string('course_name')->nullable();
            $table->string('days');
            $table->time('time_start')->nullable();
            $table->time('time_end')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->string('expected_enrollee')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('ssi_id')
                  ->references('ssi_id')
                  ->on('stud_sch_info')
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
        Schema::drop('short_course_list');
    }
}
