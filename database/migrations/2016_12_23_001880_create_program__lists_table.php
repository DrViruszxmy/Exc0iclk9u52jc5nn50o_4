<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_list', function (Blueprint $table) {

            $table->increments('pl_id');
            $table->string('prog_code');
            $table->string('prog_abv');
            $table->string('prog_name');
            $table->string('prog_desc')->nullable();
            $table->string('prog_type');
            $table->string('level');
            $table->string('major')->nullable();
            $table->string('senior_high_track')->nullable();
            $table->integer('dep_id')->unsigned();
            $table->timestamps();

            $table->foreign('dep_id')
                  ->references('dep_id')
                  ->on('department')
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
        Schema::drop('program_list');
    }
}
