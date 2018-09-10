<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prov', function (Blueprint $table) {
            $table->increments('province_id');
            $table->string('province_name');
            $table->integer('reg_id')->unsigned();
            $table->timestamps();

            $table->foreign('reg_id')
                  ->references('reg_id')
                  ->on('regions')
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
        Schema::drop('prov');
    }
}
