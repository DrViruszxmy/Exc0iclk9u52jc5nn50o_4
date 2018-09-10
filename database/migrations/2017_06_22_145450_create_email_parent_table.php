<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailParentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_parent', function (Blueprint $table) {
            $table->increments('parent_email_id');
            $table->integer('email_id')->unsigned();
            $table->integer('parent_id')->unsigned();
            $table->timestamps();

            $table->foreign('email_id')
                  ->references('email_id')
                  ->on('emails')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('parent_id')
                  ->references('parent_id')
                  ->on('parents')
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
        Schema::drop('email_parent');
    }
}
