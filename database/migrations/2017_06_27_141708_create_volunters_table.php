<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoluntersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunters', function (Blueprint $table) {
            $table->increments('volunter_id');
            $table->integer('spi_id')->unsigned();
            $table->string('organization_name')->nullable();
            $table->string('position')->nullable();
            $table->string('no_of_hours')->nullable();
            $table->string('company')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->timestamps();

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
        Schema::drop('volunters');
    }
}
