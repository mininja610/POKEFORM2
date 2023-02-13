<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;

class TypeaheadController extends Controller
{
    public function index()
    {
        return view('welcom');
    }
 
    public function autocompleteSearch(Request $request)
    {
        
            $pokemons = Pokemon::select('jp_name')->get();
            $arr = [];
            foreach($pokemons as $pokemon){
                array_push($arr,$pokemon->jp_name);
                
            }
            return $arr;
          //$query = $request->get('query');
          //$filterResult = User::where('name', 'LIKE', '%'. $query. '%')->get(5);
          //return response()->json($pokemons);
          
          
    } 

}
