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
