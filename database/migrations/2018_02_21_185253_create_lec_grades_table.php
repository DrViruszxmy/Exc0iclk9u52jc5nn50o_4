<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lec_grades', function (Blueprint $table) {
            $table->increments('lecg_id');
            $table->integer('ga_id')->unsigned();
            $table->string('quiz');
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
        Schema::dropIfExists('lec_grades');
    }
}
