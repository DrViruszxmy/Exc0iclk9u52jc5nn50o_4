<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEfsStudentModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('efs_student_modes', function (Blueprint $table) {
            $table->increments('efsm_id');
            $table->integer('ssi_id')->unsigned();
            $table->integer('efc_id')->unsigned();
            $table->string('mode');
            $table->string('sch_year');
            $table->string('semester');
            $table->date('date');
            $table->timestamps();

            $table->foreign('ssi_id')
                  ->references('ssi_id')
                  ->on('stud_sch_info')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('efc_id')
                  ->references('efc_id')
                  ->on('efs_classifications')
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
        Schema::dropIfExists('efs_student_modes');
    }
}
