<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create database
        Schema::create('lids', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->timestamps();
        });

        // Insert type of members whom will remain the same
        $data = array(
            ['title' => 'Jeugd', 'description' => 'Jonger dan 8 jaar 50% korting'],
            ['title' => 'Aspirant', 'description' => 'Van 8 tot 12 jaar 40% korting'],
            ['title' => 'Junior', 'description' => 'Van 13 tot 17 jaar 25% korting'],
            ['title' => 'Senior', 'description' => 'Van 18 tot 50 jaar 0% korting'],
            ['title' => 'Oudere', 'description' => 'Vanaf 51 jaar 45% korting']
        );

        foreach ($data as $entry) {
            DB::table('lids')->insert(
                [ 'title' => $entry['title'], 'description' => $entry['description'] ]
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
        Schema::dropIfExists('lids');
    }
}
