<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudProgTakensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stud_prog_taken', function (Blueprint $table) {
            $table->increments('spth_id');
            $table->integer('ssi_id')->unsigned();
            $table->integer('stat_id')->unsigned();
            $table->integer('pl_id')->unsigned();
            $table->string('semester');
            $table->string('sch_year');
            $table->timestamps();

            $table->foreign('ssi_id')
                  ->references('ssi_id')
                  ->on('stud_sch_info')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('stat_id')
                  ->references('stat_id')
                  ->on('stud_stat_list')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('pl_id')
                  ->references('pl_id')
                  ->on('program_list')
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
        Schema::drop('stud_prog_taken');
    }
}
