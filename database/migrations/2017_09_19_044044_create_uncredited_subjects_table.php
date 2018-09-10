<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUncreditedSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uncredited_subjects', function (Blueprint $table) {
            $table->increments('ucs_id');
            $table->integer('cr_id')->unsigned()->nullable();
            $table->integer('hss_id')->unsigned()->nullable();
            $table->integer('ssi_id')->unsigned();
            $table->string('subj_code')->nullable();
            $table->string('subj_name')->nullable();
            $table->string('subj_desc')->nullable();
            $table->string('subj_credit_number')->nullable();
            $table->string('subj_type')->nullable();
            $table->string('sch_year')->nullable();
            $table->string('semester')->nullable();
            $table->timestamps();

            $table->foreign('cr_id')
                  ->references('cr_id')
                  ->on('college_record')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('hss_id')
                  ->references('hss_id')
                  ->on('hschool_student')
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
        Schema::dropIfExists('uncredited_subjects');
    }
}
