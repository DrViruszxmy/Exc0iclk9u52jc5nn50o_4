<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateGenAvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gen_ave', function (Blueprint $table) {
            $db = DB::connection('curriculum_database')->getDatabaseName();

            $table->increments('ga_id');
            $table->string('grade');
            $table->string('semester');
            $table->string('sch_year');
            $table->integer('cs_id');
            $table->integer('cu_id')->unsigned();
            $table->timestamps();

           

            $table->foreign('cu_id')
                  ->references('cu_id')
                  ->on('curr_used')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('cs_id')
                  ->references('cs_id')
                  ->on(new Expression($db . '.cur_subject'))
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
        Schema::drop('gen_ave');
    }
}
