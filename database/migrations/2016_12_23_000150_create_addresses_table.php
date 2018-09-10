<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('add_id');
            $table->string('street')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('reg_id')->unsigned()->nullable();
            $table->integer('province_id')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->integer('brgy_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('country_id')
                  ->references('country_id')
                  ->on('country')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('reg_id')
                  ->references('reg_id')
                  ->on('regions')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('province_id')
                  ->references('province_id')
                  ->on('prov')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('city_id')
                  ->references('city_id')
                  ->on('city')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('brgy_id')
                  ->references('brgy_id')
                  ->on('brgy')
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
        Schema::drop('address');
    }
}
