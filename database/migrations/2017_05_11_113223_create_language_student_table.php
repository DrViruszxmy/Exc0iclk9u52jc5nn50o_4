<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_student', function (Blueprint $table) {
            $table->increments('language_student_id');
            $table->integer('language_id')->unsigned();
            $table->integer('spi_id')->unsigned();
            $table->timestamps();

            $table->foreign('language_id')
                  ->references('language_id')
                  ->on('languages')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('spi_id')
                  ->references('spi_id')
                  ->on('stud_per_info')
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
        Schema::drop('language_student');
    }
}
