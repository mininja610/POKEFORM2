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
        Schema::create('party_pokemon', function (Blueprint $table) {
            $table->unsignedBigInteger('party_id');
            $table->unsignedBigInteger('pokemon_id');
            
             //外部キー制約 
            $table->foreign('party_id')->references('id')->on('parties');
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
        Schema::dropIfExists('party_pokemons');
    }
};
