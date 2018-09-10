<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementFilePathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirement_file_paths', function (Blueprint $table) {
            $table->increments('req_fp_id');
            $table->integer('req_id')->unsigned();
            $table->string('file_path')->nullable();
            $table->timestamps();

            $table->foreign('req_id')
                  ->references('req_id')
                  ->on('requirements')
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
        Schema::dropIfExists('requirement_file_paths');
    }
}
