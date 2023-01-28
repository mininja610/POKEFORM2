<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    use HasFactory;
    
    protected $table = 'moves';
    
    // 初期値の定義
    protected $attributes = [
        'power'=> '0',
        
    ];
    
    protected $fillable = [
                    'name',
                    'type',
                    'power',
                    'category'
                    ];   
    
    public function pokemons()
{
    return $this->belongsToMany(Pokemon::class);
}
}
