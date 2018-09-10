<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEfsClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('efs_classifications', function (Blueprint $table) {
            $table->increments('efc_id');
            $table->integer('ef_id')->unsigned();
            $table->integer('efv_id')->unsigned();
            $table->timestamps();

            $table->foreign('ef_id')
                  ->references('ef_id')
                  ->on('enrollment_flow_sources')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('efv_id')
                  ->references('efv_id')
                  ->on('efs_versions')
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
        Schema::dropIfExists('efs_classifications');
    }
}
