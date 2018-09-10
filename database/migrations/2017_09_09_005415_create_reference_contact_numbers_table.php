<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceContactNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_contact_numbers', function (Blueprint $table) {
            $table->increments('reference_num_id');
            $table->integer('reference_id')->unsigned();
            $table->string('number')->nullable();
            $table->timestamps();

            $table->foreign('reference_id')
                  ->references('reference_id')
                  ->on('references')
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
        Schema::dropIfExists('reference_contact_numbers');
    }
}
