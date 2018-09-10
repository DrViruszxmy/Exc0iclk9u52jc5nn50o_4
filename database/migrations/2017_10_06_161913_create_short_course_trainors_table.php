<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateShortCourseTrainorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_course_trainors', function (Blueprint $table) {
            $db = DB::connection('dtrps_database')->getDatabaseName();

            $table->increments('sct_id');
            $table->integer('scl_id')->unsigned();
            $table->string('employee_id');
            $table->timestamps();

            $table->foreign('scl_id')
                  ->references('scl_id')
                  ->on('short_course_list')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // $table->foreign('employee_id')
            //       ->references('employee_id')
            //       ->on(new Expression($db . '.employees'))
            //       ->onDelete('cascade')
            //       ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('short_course_trainors');
    }
}
