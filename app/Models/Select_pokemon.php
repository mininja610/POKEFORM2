<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class select_pokemon extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'party_id',
    'first_pokemon_id',
    'second_pokemon_id',
    'third_pokemon_id',
];

    public function party(){
    return $this->belongsTo(Party::class);
}
     public function pokemon(){
    return $this->belongsTo(Pokemon::class);
}
    
    
}


