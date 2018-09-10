<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_student', function (Blueprint $table) {
            $table->increments('stud_email_id');
            $table->integer('email_id')->unsigned();
            $table->integer('spi_id')->unsigned();
            $table->timestamps();

            $table->foreign('email_id')
                  ->references('email_id')
                  ->on('emails')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('spi_id')
                  ->references('spi_id')
                  ->on('stud_per_info')
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
        Schema::drop('email_student');
    }
}
