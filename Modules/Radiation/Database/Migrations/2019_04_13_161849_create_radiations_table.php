<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRadiationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radiations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('timing')->nullable();
            $table->float('january')->nullable()->unsigned();
            $table->float('february')->nullable()->unsigned();
            $table->float('march')->nullable()->unsigned();
            $table->float('april')->nullable()->unsigned();
            $table->float('may')->nullable()->unsigned();
            $table->float('june')->nullable()->unsigned();
            $table->float('july')->nullable()->unsigned();
            $table->float('august')->nullable()->unsigned();
            $table->float('september')->nullable()->unsigned();
            $table->float('october')->nullable()->unsigned();
            $table->float('november')->nullable()->unsigned();
            $table->float('december')->nullable()->unsigned();
            $table->float('avg')->nullable()->unsigned();
            $table->bigInteger('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
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
        Schema::dropIfExists('radiations');
    }
}
