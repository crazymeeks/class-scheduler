<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_level', function (Blueprint $table) {
            $table->increments('id');
            $table->string('faculty_id_number');
            $table->integer('level_id')->unsigned();

            $table->foreign('faculty_id_number')->references('id_number')->on('faculties');

            $table->foreign('level_id')->references('id')->on('levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_level');
    }
}
