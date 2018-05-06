<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('level_id')->unsigned();
            $table->integer('subject_type_id')->unsigned();
            $table->integer('semester_id')->unsigned();
            $table->string('units', 10)->comment('Subjects unit');
            $table->string('name', 100);
            $table->string('code', 20);
            $table->string('short_description', 255)->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('subject_type_id')->references('id')->on('subject_types');
            $table->foreign('semester_id')->references('id')->on('semesters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
