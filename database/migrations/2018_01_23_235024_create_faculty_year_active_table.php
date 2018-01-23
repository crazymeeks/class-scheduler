<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyYearActiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_year_active', function (Blueprint $table) {
            $table->increments('id');
            $table->string('faculty_id_number');
            $table->integer('year_active_id')->unsigned();

            $table->foreign('faculty_id_number')->references('id_number')->on('faculties');
            $table->foreign('year_active_id')->references('id')->on('year_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_year_active');
    }
}
