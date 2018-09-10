<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeOverridesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_override', function (Blueprint $table) {
            $table->increments('go_id');
            $table->string('instructor');
            $table->string('remarks');
            $table->string('ip_address');
            $table->string('registrar');
            $table->date('date_override');
            $table->integer('sg_id')->unsigned();
            $table->timestamps();

            $table->foreign('sg_id')
                  ->references('sg_id')
                  ->on('stud_grade')
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
        Schema::drop('grade_override');
    }
}
