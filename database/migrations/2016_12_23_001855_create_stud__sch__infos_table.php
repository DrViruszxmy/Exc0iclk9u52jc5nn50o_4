<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudSchInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stud_sch_info', function (Blueprint $table) {
            $table->increments('ssi_id');
            $table->string('stud_id')->nullable();
            $table->string('acct_no');
            $table->string('usn_no');
            $table->string('dep_ed_id')->nullable();
            $table->integer('spi_id')->unsigned();
            $table->integer('st_id')->unsigned();
            $table->timestamps();

            $table->foreign('spi_id')
                  ->references('spi_id')
                  ->on('stud_per_info')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('st_id')
                  ->references('st_id')
                  ->on('stud_type')
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
        Schema::drop('stud_sch_info');
    }
}
