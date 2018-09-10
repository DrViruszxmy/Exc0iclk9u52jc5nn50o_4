<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentPhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_phone', function (Blueprint $table) {
            $table->increments('parent_phone_id');
            $table->integer('phone_id')->unsigned();
            $table->integer('parent_id')->unsigned();
            $table->timestamps();

            $table->foreign('phone_id')
                  ->references('phone_id')
                  ->on('phone_numbers')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('parent_id')
                  ->references('parent_id')
                  ->on('parents')
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
        Schema::drop('parent_phone');
    }
}
