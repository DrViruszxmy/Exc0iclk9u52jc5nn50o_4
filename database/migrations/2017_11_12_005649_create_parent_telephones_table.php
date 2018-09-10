<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentTelephonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_telephones', function (Blueprint $table) {
            $table->increments('pt_id');
            $table->integer('telephone_id')->unsigned();
            $table->integer('parent_id')->unsigned();
            $table->timestamps();

            $table->foreign('telephone_id')
                  ->references('telephone_id')
                  ->on('telephone_numbers')
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
        Schema::dropIfExists('parent_telephones');
    }
}
