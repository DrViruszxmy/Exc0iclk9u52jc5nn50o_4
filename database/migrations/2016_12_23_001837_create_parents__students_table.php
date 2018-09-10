<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents_student', function (Blueprint $table) {
            $table->increments('ps_id');
            $table->integer('parent_id')->unsigned();
            $table->integer('spi_id')->unsigned();
            $table->integer('rel_id')->unsigned();
            $table->timestamps();

            $table->foreign('parent_id')
                  ->references('parent_id')
                  ->on('parents')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('spi_id')
                  ->references('spi_id')
                  ->on('stud_per_info')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('rel_id')
                  ->references('rel_id')
                  ->on('relationship')
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
        Schema::drop('parents_student');
    }
}
