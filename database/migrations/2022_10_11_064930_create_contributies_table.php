<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributies', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('boekjaar_id');
            $table->foreign('boekjaar_id')->references('id')->on('boekjaar')->onDelete('cascade');

            $table->unsignedInteger('lid_id');
            $table->foreign('boekjaar_id')->references('id')->on('boekjaar')->onDelete('cascade');

            $table->integer('boekjaarId');
            $table->integer('familieLidId');
            $table->integer('leeftijd');
            $table->integer('lid');
            $table->integer('bedrag');
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
        Schema::dropIfExists('contributies');
    }
}
