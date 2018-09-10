<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_history', function (Blueprint $table) {
            $table->increments('th_id');
            $table->string('date');
            $table->string('time');
            $table->string('responsible');
            $table->string('registered_ip');
            $table->string('trans_type');
            $table->integer('pl_id')->unsigned();
            $table->timestamps();

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
        Schema::drop('trans_history');
    }
}
