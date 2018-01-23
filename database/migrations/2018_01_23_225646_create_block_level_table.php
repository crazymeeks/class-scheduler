<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_level', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('block_id')->unsigned();
            $table->integer('level_id')->unsigned();

            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('block_id')->references('id')->on('blocks');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('block_level');
    }
}
