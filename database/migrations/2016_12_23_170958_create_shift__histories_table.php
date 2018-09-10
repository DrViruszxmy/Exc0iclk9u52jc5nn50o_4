<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_history', function (Blueprint $table) {
            $table->increments('sh_id');
            $table->integer('sp_id')->unsigned();
            $table->timestamps();

            $table->foreign('sp_id')
                  ->references('sp_id')
                  ->on('stud_program')
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
        Schema::drop('shift_history');
    }
}
