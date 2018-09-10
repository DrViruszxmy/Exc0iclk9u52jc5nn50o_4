<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSMainAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_main_address', function (Blueprint $table) {
            $table->increments('sma_id');
            $table->integer('spi_id')->unsigned();
            $table->integer('add_id')->unsigned();
            $table->string('address_type');
            $table->string('use_present_address');
            $table->timestamps();

            $table->foreign('spi_id')
                  ->references('spi_id')
                  ->on('stud_per_info')
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
        Schema::drop('s_main_address');
    }
}
