<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateRegQueueingDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_queueing_departments', function (Blueprint $table) {
            $db = DB::connection('dtrps_database')->getDatabaseName();

            $table->increments('rqd_id');
            $table->integer('department_id');
            $table->string('status');
            $table->string('reg_user');
            $table->date('date_reg');
            $table->timestamps();

            $table->foreign('department_id')
                  ->references('department_id')
                  ->on(new Expression($db . '.departments'))
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
        Schema::dropIfExists('reg_queueing_departments');
    }
}
