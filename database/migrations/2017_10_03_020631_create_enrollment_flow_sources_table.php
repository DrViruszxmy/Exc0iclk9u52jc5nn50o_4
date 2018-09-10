<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentFlowSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment_flow_sources', function (Blueprint $table) {
            $table->increments('ef_id');
            $table->integer('mod_id')->unsigned();
            $table->string('step_number');
            $table->string('location');
            $table->string('steps_title');
            $table->string('img_path')->nullable();
            $table->timestamps();

            $table->foreign('mod_id')
                  ->references('mod_id')
                  ->on('enrollment_modules')
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
        Schema::dropIfExists('enrollment_flow_sources');
    }
}
