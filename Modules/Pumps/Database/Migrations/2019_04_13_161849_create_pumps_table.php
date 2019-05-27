<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePumpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pumps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model');
            $table->integer('q_min');
            $table->integer('q_max');
            $table->integer('h_min');
            $table->integer('h_max');
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
        Schema::dropIfExists('pumps');
    }
}
