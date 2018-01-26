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
            $table->string('faculty_id_number', 50)->comment('The faculty id number')->unique();
            $table->integer('faculty_type_id')->unsigned();
            $table->integer('institution_id')->unsigned();
            $table->string('lastname', 50);
            $table->string('firstname', 50);
            $table->string('middlename', 50)->nullable();
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->longText('address');
            $table->string('graduated_school_name', 255);
            $table->string('other_school', 255)->nullable();
            $table->string('major', 255)->nullable();
            $table->string('minor', 255)->nullable();
            $table->decimal('minimum_units', 4, 1)->default(0);
            $table->decimal('maximum_units', 4, 1)->default(0);
            $table->string('earned_ma', 255)->nullable();
            $table->string('ms_mba', 255)->nullable();
            $table->string('phd', 255)->nullable();
            $table->longText('special_training')->nullable();
            $table->integer('years_of_experience')->default(0);
            $table->decimal('basic_salary', 18, 2)->default(5000);
            $table->string('assignment', 255)->nullable();
            $table->string('position', 255)->nullable();
            $table->integer('priority_level')->default(1);
            $table->integer('status')->default(1)->comment('0=inactive; 1=active')->unsigned();
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
