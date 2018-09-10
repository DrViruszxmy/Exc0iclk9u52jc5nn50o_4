<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentEnrollmentStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_enrollment_stat', function (Blueprint $table) {
            $table->increments('ses_id');
            $table->integer('ssi_id')->unsigned();
            $table->string('status');
            $table->string('sch_year');
            $table->string('semester');
            $table->date('dated');
            $table->string('actions')->nullable();
            $table->timestamps();

            $table->foreign('ssi_id')
                  ->references('ssi_id')
                  ->on('stud_sch_info')
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
        Schema::dropIfExists('student_enrollment_stat');
    }
}
