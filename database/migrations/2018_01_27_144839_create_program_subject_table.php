<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->softDeletes();
            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_subject');
    }
}
