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
            $table->integer('contribution');
            $table->timestamps();
        });

        // Insert book years into the database
        $years = array(
            ['year' => 2021, 'contribution' => 200],
            ['year' => 2022, 'contribution' => 500],
            ['year' => 2023, 'contribution' => 700]
        );
        
        foreach ($years as $year) {
            DB::table('boekjaars')->insert(
                [ 'bookyear' => $year['year'], 'contribution' => $year['contribution'] ]
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
