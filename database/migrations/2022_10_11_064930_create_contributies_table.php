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

            $table->integer('age');
            $table->integer('lid_type');
            $table->integer('amount');

            $table->unsignedBigInteger('familie_lid');
            $table->foreign('familie_lid')->references('id')->on('lids')->onDelete('cascade');

            $table->unsignedBigInteger('bookyear_id');
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
