<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_grades', function (Blueprint $table) {
            $table->increments('labg_id');
            $table->integer('ga_id')->unsigned();
            $table->string('exercise');
            $table->string('exam');
            $table->string('class_standing');
            $table->string('grade');
            $table->string('period');
            $table->timestamps();

            $table->foreign('ga_id')
                  ->references('ga_id')
                  ->on('gen_ave')
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
        Schema::dropIfExists('lab_grades');
    }
}
