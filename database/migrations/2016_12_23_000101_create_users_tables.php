<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

class CreateUsersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $db = DB::connection('dtrps_database')->getDatabaseName();

            $table->increments('user_id');
            $table->string('employee_id')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('account_span');
            $table->string('status');
            $table->rememberToken();
            $table->timestamps();

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
        Schema::drop('users');
    }
}
