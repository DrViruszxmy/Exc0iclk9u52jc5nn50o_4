<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEfStudentUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ef_student_uses', function (Blueprint $table) {
            $table->increments('efsu_id');
            $table->integer('ssi_id')->unsigned();
            $table->integer('efv_id')->unsigned();
            $table->string('sch_year');
            $table->string('semester');
            $table->date('date_used');
            $table->timestamps();

            $table->foreign('ssi_id')
                  ->references('ssi_id')
                  ->on('stud_sch_info')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('efv_id')
                  ->references('efv_id')
                  ->on('efs_versions')
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
        Schema::dropIfExists('ef_student_uses');
    }
}
