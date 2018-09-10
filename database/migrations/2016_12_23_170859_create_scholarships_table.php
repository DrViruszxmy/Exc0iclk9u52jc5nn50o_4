<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScholarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholarship', function (Blueprint $table) {
            $table->increments('s_id');
            $table->integer('ssi_id')->unsigned();
            $table->integer('sl_id')->unsigned();
            $table->string('sch_year');
            $table->string('semester');
            $table->timestamps();

            $table->foreign('ssi_id')
                  ->references('ssi_id')
                  ->on('stud_sch_info')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('sl_id')
                  ->references('sl_id')
                  ->on('scholarship_list')
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
        Schema::drop('scholarship');
    }
}
