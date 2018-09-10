<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditingHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crediting_history', function (Blueprint $table) {
            $table->increments('ch_id');
            $table->integer('user_id')->unsigned();
            $table->integer('cu_id')->unsigned();
            $table->string('credit_code');
            $table->date('credit_date');
            $table->string('mode');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('cu_id')
                  ->references('cu_id')
                  ->on('curr_used')
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
        Schema::drop('crediting_history');
    }
}
