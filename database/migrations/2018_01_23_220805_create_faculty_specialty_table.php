<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultySpecialtyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_specialty', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specialty_id')->unsigned();
            $table->integer('faculty_id')->unsigned();

            $table->foreign('specialty_id')->references('id')->on('specialties');
            $table->foreign('faculty_id')->references('id')->on('faculties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_specialty');
    }
}
