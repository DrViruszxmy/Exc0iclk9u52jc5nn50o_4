<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivationHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activation_histories', function (Blueprint $table) {
            $table->increments('th_id');
            $table->integer('pl_id')->unsigned();
            $table->integer('responsible')->unsigned();
            $table->date('date');
            $table->time('time');
            $table->string('registered_ip');
            $table->string('trans_type');
            $table->timestamps();

            $table->foreign('responsible')
                  ->references('user_id')
                  ->on('users')
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
        Schema::dropIfExists('activation_histories');
    }
}
