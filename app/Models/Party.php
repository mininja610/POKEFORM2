<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;
    
     protected $fillable = [
                    'title',
                    'content',
                    'match',
                    'user_id'
                    ];
    
    protected $attributes = [
        'match' => '0',
    ];
    
    
    public function pokemons()
{
    return $this->belongsToMany(Pokemon::class);
}


public function getByLimit(int $limit_count = 5)
{
    // updated_atで降順に並べたあと、limitで件数制限をかける
    return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
}

public function select_pokemons()   
{
    return $this->hasMany(Select_pokemon::class);  
}
public function histories()   
{
    return $this->hasMany(History::class);  
}


}
