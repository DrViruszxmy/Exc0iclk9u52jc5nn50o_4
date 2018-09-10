<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactPersonNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_person_numbers', function (Blueprint $table) {
            $table->increments('contact_person_num_id');
            $table->integer('contact_person_id')->unsigned();
            $table->string('number')->nullable();
            $table->timestamps();

            $table->foreign('contact_person_id')
                  ->references('contact_person_id')
                  ->on('contact_people')
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
        Schema::dropIfExists('contact_person_numbers');
    }
}
