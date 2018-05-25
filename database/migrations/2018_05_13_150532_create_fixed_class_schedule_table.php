<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFixedClassScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_class_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('semester_id')->unsigned();
            $table->integer('program_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->integer('block_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('day_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->integer('faculty_id')->unsigned();
            $table->string('start_time', 8);
            $table->string('end_time', 8);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('semester_id')
                  ->references('id')
                  ->on('semesters')
                  ->onDelete('cascade');

            $table->foreign('program_id')
                  ->references('id')
                  ->on('programs')
                  ->onDelete('cascade');

            $table->foreign('level_id')
                  ->references('id')
                  ->on('levels')
                  ->onDelete('cascade');

            $table->foreign('block_id')
                  ->references('id')
                  ->on('blocks')
                  ->onDelete('cascade');

            $table->foreign('subject_id')
                  ->references('id')
                  ->on('subjects')
                  ->onDelete('cascade');

            $table->foreign('day_id')
                  ->references('id')
                  ->on('days')
                  ->onDelete('cascade');

            $table->foreign('room_id')
                  ->references('id')
                  ->on('rooms')
                  ->onDelete('cascade');

            $table->foreign('faculty_id')
                  ->references('id')
                  ->on('faculties')
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
        Schema::dropIfExists('fixed_class_schedule');
    }
}
