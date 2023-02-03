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
        Schema::create('select_pokemons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('party_id')->constrained();
            $table->unsignedBigInteger('first_pokemon_id');
            $table->unsignedBigInteger('second_pokemon_id');
            $table->unsignedBigInteger('third_pokemon_id');
            $table->integer('result')->nullable();
           
           //外部キー制約 
            $table->foreign('first_pokemon_id')->references('id')->on('pokemons');
            $table->foreign('second_pokemon_id')->references('id')->on('pokemons');
            $table->foreign('third_pokemon_id')->references('id')->on('pokemons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('select_pokemons');
    }
};
