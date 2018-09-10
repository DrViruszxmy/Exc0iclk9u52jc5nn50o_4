<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortCourseEnrolledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_course_enrolled', function (Blueprint $table) {
            $table->increments('sce_id');
            $table->string('enrolled_date');
            $table->integer('scl_id')->unsigned();
            $table->integer('scs_id')->unsigned();
            $table->timestamps();

            $table->foreign('scl_id')
                  ->references('scl_id')
                  ->on('short_course_list')
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
        Schema::drop('short_course_enrolled');
    }
}
