<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultySubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id')->unsigned();
            $table->string('faculty_id_number');

            $table->foreign('subject_id')->references('id')->on('subjects');
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
        Schema::dropIfExists('faculty_subject');
    }
}
