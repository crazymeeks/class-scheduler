<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyTypeUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_type_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('min_units', 15)->comment('The minimum unit allowed to a faculty type');
            $table->string('max_units', 15)->comment('The maximum unit allowed to a faculty type');
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
        Schema::dropIfExists('faculty_type_units');
    }
}