<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSBhAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_bh_address', function (Blueprint $table) {
            $table->increments('sbha_id');
            $table->string('land_lord');
            $table->integer('spi_id')->unsigned();
            $table->integer('add_id')->unsigned();
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
        Schema::drop('s_bh_address');
    }
}
