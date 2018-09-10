<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementaryAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elementary_address', function (Blueprint $table) {
            $table->increments('elem_add_id');
            $table->integer('elementary_id')->unsigned();
            $table->integer('add_id')->unsigned();
            $table->timestamps();

            $table->foreign('elementary_id')
                  ->references('elementary_id')
                  ->on('elementary_student')
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
        Schema::drop('elementary_address');
    }
}
