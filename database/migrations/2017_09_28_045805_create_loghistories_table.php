<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoghistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loghistories', function (Blueprint $table) {
            $table->increments('lh_id');
            $table->integer('user_id')->unsigned();
            $table->date('date_log_in')->nullable();
            $table->date('date_log_out')->nullable();
            $table->time('time_log_in')->nullable();
            $table->time('time_log_out')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
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
        Schema::dropIfExists('loghistories');
    }
}
