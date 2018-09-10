<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUncreditedSubjectGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uncredited_subject_grades', function (Blueprint $table) {
            $table->increments('sg_id');
            $table->integer('ucs_id')->unsigned();
            $table->string('gen_ave')->nullable();
            $table->string('final_grade')->nullable();
            $table->timestamps();

            $table->foreign('ucs_id')
                  ->references('ucs_id')
                  ->on('uncredited_subjects')
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
        Schema::dropIfExists('uncredited_subject_grades');
    }
}
