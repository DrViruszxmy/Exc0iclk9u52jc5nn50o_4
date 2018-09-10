<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrgiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brgy', function (Blueprint $table) {
            $table->increments('brgy_id');
            $table->string('brgy_name');
            $table->integer('city_id')->unsigned();
            $table->timestamps();

            $table->foreign('city_id')
                  ->references('city_id')
                  ->on('city')
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
        Schema::drop('brgy');
    }
}
