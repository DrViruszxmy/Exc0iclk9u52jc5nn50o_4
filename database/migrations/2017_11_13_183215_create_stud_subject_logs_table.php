<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudSubjectLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stud_subject_logs', function (Blueprint $table) {
            $table->increments('stud_sub_id');
            $table->integer('se_id')->unsigned();
            $table->integer('ssi_id')->unsigned();
            $table->string('stud_sub_status');
            $table->string('stud_sub_date');
            $table->string('stud_sub_remarks');
            $table->timestamps();

            $table->foreign('se_id')
                  ->references('se_id')
                  ->on('subject_enrolled')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

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
        Schema::dropIfExists('stud_subject_logs');
    }
}
