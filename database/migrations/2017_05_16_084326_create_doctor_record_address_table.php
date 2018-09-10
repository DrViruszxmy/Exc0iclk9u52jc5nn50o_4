<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorRecordAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_record_address', function (Blueprint $table) {
            $table->increments('dr_add_id');
            $table->integer('dr_id')->unsigned();
            $table->integer('add_id')->unsigned();
            $table->timestamps();

            $table->foreign('dr_id')
                  ->references('dr_id')
                  ->on('doctor_record')
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
        Schema::drop('doctor_record_address');
    }
}
