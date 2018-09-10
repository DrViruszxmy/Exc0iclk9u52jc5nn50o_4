<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsageStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usage_status', function (Blueprint $table) {
            $table->increments('us_id');
            $table->string('status');
            $table->integer('pl_id')->unsigned();
            $table->timestamps();

            $table->foreign('pl_id')
                  ->references('pl_id')
                  ->on('program_list')
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
        Schema::drop('usage_status');
    }
}
