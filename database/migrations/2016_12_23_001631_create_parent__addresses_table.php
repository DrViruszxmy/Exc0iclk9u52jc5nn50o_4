<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_address', function (Blueprint $table) {
            $table->increments('pu_id');
            $table->integer('parent_id')->unsigned();
            $table->integer('add_id')->unsigned();
            $table->string('use_present_address')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')
                  ->references('parent_id')
                  ->on('parents')
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
        Schema::drop('parent_address');
    }
}
