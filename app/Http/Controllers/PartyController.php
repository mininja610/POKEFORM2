<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Party;
use App\Models\Select_pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\PartyRequest;
use App\Http\Requests\Select_pokemonRequest;

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
      
      //dd($pokemons_id);
    //return view('pokemons.show', ['pokemons_id' => $pokemons_id]);
    }
    public function create()
    {
        return view('parties/create');  
      
    }
    public function store(PartyRequest $request, Party $party)
    {
        $input_party = $request['party'];
        
        
        $input_pokemons = \App\Models\Pokemon::whereIn('en_name',[$request->p1,$request->p2,$request->p3,$request->p4,$request->p5,$request->p6])->get();
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
    
        $name = $pokemon->pokemons->pluck('en_name');
    
        return view('parties/edit')->with(['party' => $party,'name' =>$name]);
        
    }
    
    public function update(PartyRequest $request, Party $party){
        
         $input_party = $request['party'];
        
        
        $input_pokemons = \App\Models\Pokemon::whereIn('en_name',[$request->p1,$request->p2,$request->p3,$request->p4,$request->p5,$request->p6])->get();
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
    
    public function select(Request $request,Select_pokemon $select_pokemon,Party $party){
        
         $validator = $request->validate([       //ここがバリデーション部分
            'select_id.0' => 'required',
            'select_id.1' => 'required',
            'select_id.2' => 'required',
        ]);
        
        $id = $party->id;
        $select_ids = $request->select_id;
        $select1 = $select_ids[0];
        $select2 = $select_ids[1];
        $select3 = $select_ids[2];
        
        $select_pokemon->first_pokemon_id = $select1;
        $select_pokemon->second_pokemon_id = $select2;
        $select_pokemon->third_pokemon_id = $select3;
        $select_pokemon->party_id = $id;
        $select_pokemon->timestamps = false;//タイムスタンプのない保存
        $select_pokemon->save();
        
        $party->match = $party->match++;
        $party->save();
        
        //showに渡すデータ
        $id = $party->id;
        $pokemons_id = Party::where('id',$id)->with('pokemons')->get();
      
        return redirect()->route('party.show',['party' => $id]);
        //return view('parties/show')->with(['party' => $party,'pokemons_id' =>$pokemons_id]); 
    }
}
