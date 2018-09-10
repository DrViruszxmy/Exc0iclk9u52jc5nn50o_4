<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubModuleListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_module_lists', function (Blueprint $table) {
            $table->increments('sml_id');
            $table->integer('al_id')->unsigned();
            $table->string('sub_module');
            $table->timestamps();

            $table->foreign('al_id')
                  ->references('al_id')
                  ->on('access_lists')
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
        Schema::dropIfExists('sub_module_lists');
    }
}
