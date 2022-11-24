<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoekjaarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boekjaars', function (Blueprint $table) {
            $table->id();
            $table->integer('bookyear');
            $table->timestamps();
        });

        // Insert book years into the database
        $years = [2021, 2022, 2023];
        
        foreach ($years as $year) {
            DB::table('boekjaars')->insert(
                [ 'bookyear' => $year ]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boekjaars');
    }
}
