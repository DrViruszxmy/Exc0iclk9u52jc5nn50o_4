<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVocationalRecordAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vocational_record_address', function (Blueprint $table) {
            $table->increments('vs_add_id');
            $table->integer('vr_id')->unsigned();
            $table->integer('add_id')->unsigned();
            $table->timestamps();

            $table->foreign('vr_id')
                  ->references('vr_id')
                  ->on('vocational_record')
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
        Schema::drop('vocational_record_address');
    }
}
