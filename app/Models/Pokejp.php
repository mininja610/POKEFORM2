<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokejp extends Model
{
    use HasFactory;
    
    protected $fillable = [
                    'jp_name',
                    'p_id'
                    ];


}
