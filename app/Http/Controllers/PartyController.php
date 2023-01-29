<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\PartyRequest;

class PartyController extends Controller
{
    public function party(Party $party)
    {   $id = Auth::user ()->id;
        $parties = Party::where('user_id',$id)->get();
        return view('parties/party')->with(['parties' => $parties]);  
      
    }
    
    public function show(Party $party)
    {
        $id = $party->id;
        $pokemons_id = Party::where('id',$id)->with('pokemons')->get();
      
        return view('parties/show')->with(['party' => $party,'pokemons_id' =>$pokemons_id]);
      
      //($pokemons_id);
    //return view('pokemons.show', ['pokemons_id' => $pokemons_id]);
    }
    public function create()
    {
        return view('parties/create');  
      
    }
    public function store(PartyRequest $request, Party $party)
    {
        $input_party = $request['party'];
        
        
        $input_pokemons = \App\Models\Pokemon::whereIn('name',[$request->p1,$request->p2,$request->p3,$request->p4,$request->p5,$request->p6])->get();
       //送られた名前のポケモンの配列を作成
        $pokemon_id = $input_pokemons->pluck('id')->all();
        //id値のみ取得
        
        $party->fill($input_party)->save();
        $party->pokemons()->attach($pokemon_id);
        //保存
        
        $id = $party->id;
        $pokemons_id = Party::where('id',$id)->with('pokemons')->get();
        //showに渡すデータ
        
        return view('parties/show')->with(['party' => $party,'pokemons_id' =>$pokemons_id]);       
    }
    
    public function edit(Party $party){
        $id = $party->id;
        $pokemons_id = Party::where('id',$id)->with('pokemons')->get();
        
         foreach($pokemons_id as $pokemon){
        
         }
    
        $name = $pokemon->pokemons->pluck('name');
    
        return view('parties/edit')->with(['party' => $party,'name' =>$name]);
        
    }
    
    public function update(PartyRequest $request, Party $party){
        
         $input_party = $request['party'];
        
        
        $input_pokemons = \App\Models\Pokemon::whereIn('name',[$request->p1,$request->p2,$request->p3,$request->p4,$request->p5,$request->p6])->get();
       //送られた名前のポケモンの配列を作成
        $pokemon_id = $input_pokemons->pluck('id')->all();
        //id値のみ取得
        
        $party->fill($input_party)->save();
        $party->pokemons()->sync($pokemon_id);
        
        //showに渡すデータ
        $id = $party->id;
        $pokemons_id = Party::where('id',$id)->with('pokemons')->get();
        return view('parties/show')->with(['party' => $party,'pokemons_id' =>$pokemons_id]);
    }
    
    public function delete(Party $party){
        $party->pokemons()->detach();
        $party->delete();
        
        return redirect('/parties');
    }
}
