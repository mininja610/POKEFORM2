<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    
    protected $fillable = [
                    'result',
                    'content',
                    'format',
                    'season',
                    'user_id'
                    ];
public function pokemons()
{
    return $this->belongsToMany(Pokemon::class);
}

}
