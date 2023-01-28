<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move_pokemon', function (Blueprint $table) {
            $table->unsignedBigInteger('move_id');
            $table->unsignedBigInteger('pokemon_id');
            
             //外部キー制約 
            $table->foreign('move_id')->references('id')->on('moves');
            $table->foreign('pokemon_id')->references('id')->on('pokemons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('move_pokemons');
    }
};
