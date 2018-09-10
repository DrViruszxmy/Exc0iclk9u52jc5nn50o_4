<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiblingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siblings', function (Blueprint $table) {
            $table->increments('sib_id');
            $table->integer('stud_id')->unsigned();
            $table->integer('spi_id')->unsigned();
            $table->timestamps();

            $table->foreign('stud_id')
                  ->references('stud_id')
                  ->on('student')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('spi_id')
                  ->references('spi_id')
                  ->on('stud_per_info')
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
        Schema::drop('siblings');
    }
}
