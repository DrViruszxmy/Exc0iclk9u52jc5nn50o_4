<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEligibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eligibilities', function (Blueprint $table) {
            $table->increments('eligibility_id');
            $table->integer('spi_id')->unsigned();
            $table->string('type')->nullable();
            $table->string('rating')->nullable();
            $table->string('place_of_exam')->nullable();
            $table->string('license_no')->nullable();
            $table->string('date_of_exam')->nullable();
            $table->string('date_of_release')->nullable();
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
        Schema::drop('eligibilities');
    }
}
