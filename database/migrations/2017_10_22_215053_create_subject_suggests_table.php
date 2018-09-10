<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateSubjectSuggestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_suggests', function (Blueprint $table) {
            $db = DB::connection('curriculum_database')->getDatabaseName();

            $table->increments('sg_id');
            $table->integer('ssi_id')->unsigned();
            $table->integer('ss_id');
            $table->string('sch_year');
            $table->string('semester');
            $table->timestamps();

            $table->foreign('ssi_id')
                  ->references('ssi_id')
                  ->on('stud_sch_info')
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
        Schema::dropIfExists('subject_suggests');
    }
}
