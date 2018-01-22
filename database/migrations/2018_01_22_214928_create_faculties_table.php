<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faculty_type_id')->unsigned();
            $table->integer('institution_id')->unsigned();
            $table->string('faculty_id_number', 50)->nullable()->unique();
            $table->string('lastname', 50);
            $table->string('firstname', 50);
            $table->string('middlename', 50)->nullable();
            $table->integer('status')->default(1)->comment('0=inactive; 1=active; 2=locked')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('faculty_type_id')->references('id')->on('faculty_types');
            $table->foreign('institution_id')->references('id')->on('institutions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculties');
    }
}
