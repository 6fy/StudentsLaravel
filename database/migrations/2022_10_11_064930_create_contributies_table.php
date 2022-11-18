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
            $table->bigIncrements('id');

            $table->unsignedBigInteger('lid_id');
            $table->unsignedBigInteger('bookyear_id');

            $table->integer('bookyearId');
            $table->integer('familyLidId');
            $table->integer('age');
            $table->integer('lid');
            $table->integer('amount');

            $table->foreign('lid_id')->references('id')->on('lids')->onDelete('cascade');
            $table->foreign('bookyear_id')->references('id')->on('boekjaars')->onDelete('cascade');

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
