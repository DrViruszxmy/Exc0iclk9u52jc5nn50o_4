<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stud_grade', function (Blueprint $table) {
            $table->increments('sg_id');
            $table->string('prelim');
            $table->string('midterm');
            $table->string('prefinal');
            $table->string('final');
            $table->integer('se_id')->unsigned();
            $table->timestamps();

            $table->foreign('se_id')
                  ->references('se_id')
                  ->on('subject_enrolled')
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
        Schema::drop('stud_grade');
    }
}
