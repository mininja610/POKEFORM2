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
        Schema::create('history_pokemon', function (Blueprint $table) {
            $table->unsignedBigInteger('history_id');
            $table->unsignedBigInteger('pokemon_id');
            
             //外部キー制約 
            $table->foreign('history_id')->references('id')->on('histories');
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
        Schema::dropIfExists('history_pokemons');
    }
};
