<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_program', function (Blueprint $table) {
             $table->increments('id');
            $table->integer('program_id')->unsigned();
            $table->string('faculty_id_number');

            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('faculty_id_number')->references('id_number')->on('faculties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_program');
    }
}
