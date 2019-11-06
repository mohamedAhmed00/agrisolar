<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('motor_hp')->nullable();
            $table->string('c_3x1-5')->nullable();
            $table->string('c_3x2-5')->nullable();
            $table->string('c_3x4')->nullable();
            $table->string('c_3x6')->nullable();
            $table->string('c_3x10')->nullable();
            $table->string('c_3x16')->nullable();
            $table->string('c_3x25')->nullable();
            $table->string('c_3x35')->nullable();
            $table->string('c_3x50')->nullable();
            $table->string('c_3x70')->nullable();
            $table->string('c_3x95')->nullable();
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
        Schema::dropIfExists('cables');
    }
}
