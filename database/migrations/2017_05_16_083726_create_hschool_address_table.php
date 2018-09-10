<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHschoolAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hschool_address', function (Blueprint $table) {
            $table->increments('hs_add_id');
            $table->integer('hss_id')->unsigned();
            $table->integer('add_id')->unsigned();
            $table->timestamps();

            $table->foreign('hss_id')
                  ->references('hss_id')
                  ->on('hschool_student')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('add_id')
                  ->references('add_id')
                  ->on('address')
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
        Schema::drop('hschool_address');
    }
}
