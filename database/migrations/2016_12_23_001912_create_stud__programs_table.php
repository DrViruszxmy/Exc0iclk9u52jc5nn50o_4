<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stud_program', function (Blueprint $table) {
            $table->increments('sp_id');
            $table->string('semester');
            $table->string('sch_year');
            $table->integer('pl_id')->unsigned();
            $table->integer('ssi_id')->unsigned();
            $table->timestamps();

            $table->foreign('pl_id')
                  ->references('pl_id')
                  ->on('program_list')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

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
        Schema::drop('stud_program');
    }
}
