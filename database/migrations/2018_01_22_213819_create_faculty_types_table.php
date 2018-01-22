<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faculty_type_unit_id')->unsigned();
            $table->string('type', 50)->comment('The types of faculty.')->unique();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('faculty_type_unit_id')->references('id')->on('faculty_type_units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_types');
    }
}
