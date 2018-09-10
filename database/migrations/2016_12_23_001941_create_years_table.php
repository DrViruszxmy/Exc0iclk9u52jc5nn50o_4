<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('year', function (Blueprint $table) {
            $table->increments('y_id');
            $table->string('sch_year');
            $table->string('year');
            $table->string('year_stat');
            $table->string('remarks')->nullable();
            $table->string('current_stat');
            $table->string('semester');
            $table->integer('ssi_id')->unsigned();
            $table->timestamps();

            $table->foreign('ssi_id')
                  ->references('ssi_id')
                  ->on('stud_sch_info')
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
        Schema::drop('year');
    }
}
