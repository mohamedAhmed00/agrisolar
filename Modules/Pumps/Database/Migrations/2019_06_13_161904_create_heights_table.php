<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('height_pumps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('c0');
            $table->integer('c1');
            $table->integer('c2');
            $table->integer('c3');
            $table->integer('c4');
            $table->integer('c5');
            $table->integer('q_max');
            $table->integer('q_min');
            $table->integer('p_min');
            $table->integer('p_max');
            $table->integer('pump_id')->unsigned()->index()->foreign('pump_id')->references("id")->on("pumps")->onDelete("cascade");
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
        Schema::dropIfExists('height_pumps');
    }
}
