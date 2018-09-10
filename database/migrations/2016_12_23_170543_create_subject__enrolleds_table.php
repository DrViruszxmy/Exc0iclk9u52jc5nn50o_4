<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateSubjectEnrolledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_enrolled', function (Blueprint $table) {
            $db = DB::connection('curriculum_database')->getDatabaseName();

            $table->increments('se_id');
            $table->integer('ssi_id')->unsigned();
            $table->integer('ses_id')->unsigned()->nullable();
            $table->integer('ss_id');
            $table->string('sch_year');
            $table->string('semester');
            $table->timestamps();

            $table->foreign('ssi_id')
                  ->references('ssi_id')
                  ->on('stud_sch_info')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('ses_id')
                  ->references('ses_id')
                  ->on('subject_enrolled_status')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('ss_id')
                  ->references('ss_id')
                  ->on(new Expression($db . '.sched_subj'))
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
        Schema::drop('subject_enrolled');
    }
}
