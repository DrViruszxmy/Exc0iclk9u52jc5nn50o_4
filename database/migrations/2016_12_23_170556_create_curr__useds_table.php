<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrUsedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curr_used', function (Blueprint $table) {
            $table->increments('cu_id');
            $table->string('c_code');
            $table->string('semester');
            $table->string('sch_year');
            $table->string('status');
            $table->integer('ssi_id')->unsigned();
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
        Schema::drop('curr_used');
    }
}
