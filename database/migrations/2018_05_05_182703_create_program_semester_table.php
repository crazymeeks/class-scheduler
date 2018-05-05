<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramSemesterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_semester', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id')->unsigned();
            $table->integer('semester_id')->unsigned();

            $table->index(['program_id', 'semester_id']);

            $table->foreign('program_id')
                  ->references('id')
                  ->on('programs')
                  ->onDelete('cascade');

            $table->foreign('semester_id')
                  ->references('id')
                  ->on('semesters')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_semester');
    }
}
