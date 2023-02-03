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
    {   $match = $party->match;//総試合数
        $id = $party->id;
        $pokemons = Party::where('id',$id)->with('pokemons')->get();
                foreach($pokemons as $pokemon_pro){//$pokemonsはコレクションで、$pokemon_proで初めて6匹とのリレーションを持つparty情報になる→したがい、ポケモン1匹ずつの扱いにはもう一回foreachと->'pokemons'が必要
                                                                                                
           foreach($pokemon_pro->pokemons as $pokemon){//$pokemon_はparty情報なので、そこから->することで6匹のポケモン情報が抜け出せる                                                                                      //foreach($p_id as $i){
        
         $count = \App\Models\Select_pokemon::where('first_pokemon_id',$pokemon->id)->where('party_id',$party->id)//party_idとの一致を追加
                                                 ->orWhere('second_pokemon_id',$pokemon->id)->where('party_id',$party->id)
                                                 ->orWhere('third_pokemon_id',$pokemon->id)->where('party_id',$party->id)                                                                                                     //}//選出された回数
                                                 ->count();
        if($match ==0){
        $probability = 0;
        }else{
        $probability = intval($count*100/$match);
        }
        $pokemon['probability'] = $probability;//$pokemonに新たに選出率を付随する
        //この時点で、$pokemon_proが$probabilityを付随した$partyになる
        }}
        //dd($pokemon_pro->pokemons);したがい、このデバックでポケモン6匹の$probabilityを付随した情報が得られる
        $pokemon_pro = $pokemon_pro->pokemons;
        
         //partyの勝率を計算する処理
        $win = \App\Models\Select_pokemon::where('result',1)->where('party_id',$party->id)->count();
        if($win ==0){
            $winrate = 0;
        }else{
            $winrate = intval($win*100/$match);
        }
        $party['winrate'] = $winrate;
      
        return view('parties/show')->with(['party' => $party,'pokemon_pro' =>$pokemon_pro,]);
        
       
      
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
        
        //保存
        $party->fill($input_party)->save();
        $party->pokemons()->attach($pokemon_id);
        
        //showに渡すデータ
        $match = $party->match;//総試合数
        $id = $party->id;
        $pokemons = Party::where('id',$id)->with('pokemons')->get();
                foreach($pokemons as $pokemon_pro){//$pokemonsはコレクションで、$pokemon_proで初めて6匹とのリレーションを持つparty情報になる→したがい、ポケモン1匹ずつの扱いにはもう一回foreachと->'pokemons'が必要
                                                                                                
           foreach($pokemon_pro->pokemons as $pokemon){//$pokemon_はparty情報なので、そこから->することで6匹のポケモン情報が抜け出せる                                                                                      //foreach($p_id as $i){
        
         $count = \App\Models\Select_pokemon::where('first_pokemon_id',$pokemon->id)->where('party_id',$party->id)//party_idとの一致を追加
                                                 ->orWhere('second_pokemon_id',$pokemon->id)->where('party_id',$party->id)
                                                 ->orWhere('third_pokemon_id',$pokemon->id)->where('party_id',$party->id)                                                                                                     //}//選出された回数
                                                 ->count();
        
        if($match ==0){
        $probability = 0;
        }else{
        $probability = intval($count*100/$match);
        }
        $pokemon['probability'] = $probability;//$pokemonに新たに選出率を付随する
        //この時点で、$pokemon_proが$probabilityを付随した$partyになる
        }}
        //dd($pokemon_pro->pokemons);したがい、このデバックでポケモン6匹の$probabilityを付随した情報が得られる
        $pokemon_pro = $pokemon_pro->pokemons;
        
         //partyの勝率を計算する処理
        $win = \App\Models\Select_pokemon::where('result',1)->where('party_id',$party->id)->count();
        if($win ==0){
            $winrate = 0;
        }else{
            $winrate = intval($win*100/$match);
        }
        $party['winrate'] = $winrate;
        
        return view('parties/show')->with(['party' => $party,'pokemon_pro' =>$pokemon_pro]);       
    }
    
    public function edit(Party $party){
        $id = $party->id;
        $pokemons = Party::where('id',$id)->with('pokemons')->get();//
        
         foreach($pokemons as $pokemon){
        
         
    
        $name = $pokemon->pokemons->pluck('en_name');
        
         //partyの勝率を計算する処理
        
         }
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
        $match = $party->match;//総試合数
        $id = $party->id;
        $pokemons = Party::where('id',$id)->with('pokemons')->get();
        foreach($pokemons as $pokemon_pro){//$pokemonsはコレクションで、$pokemon_proで初めて6匹とのリレーションを持つparty情報になる→したがい、ポケモン1匹ずつの扱いにはもう一回foreachと->'pokemons'が必要
                                                                                                
           foreach($pokemon_pro->pokemons as $pokemon){//$pokemon_はparty情報なので、そこから->することで6匹のポケモン情報が抜け出せる                                                                                      //foreach($p_id as $i){
        
         $count = \App\Models\Select_pokemon::where('first_pokemon_id',$pokemon->id)->where('party_id',$party->id)//party_idとの一致を追加
                                                 ->orWhere('second_pokemon_id',$pokemon->id)->where('party_id',$party->id)
                                                 ->orWhere('third_pokemon_id',$pokemon->id)->where('party_id',$party->id)                                                                                                     //}//選出された回数
                                                 ->count();
        
        if($match ==0){
        $probability = 0;
        }else{
        $probability = intval($count*100/$match);
        }
        $pokemon['probability'] = $probability;//$pokemonに新たに選出率を付随する
        //この時点で、$pokemon_proが$probabilityを付随した$partyになる
        }}
        $pokemon_pro = $pokemon_pro->pokemons;
        
         //partyの勝率を計算する処理
        $win = \App\Models\Select_pokemon::where('result',1)->where('party_id',$party->id)->count();
        if($win ==0){
            $winrate = 0;
        }else{
            $winrate = intval($win*100/$match);
        }
        $party['winrate'] = $winrate;
       
        return view('parties/show')->with(['party' => $party,'pokemon_pro' =>$pokemon_pro]);
    }
    
    public function delete(Party $party){
        $party->pokemons()->detach();
        $party->select_pokemons()->delete();
        $party->delete();
        
        return redirect('/parties');
    }
    
    public function select(Request $request,Select_pokemon $select_pokemon,Party $party){
        
         $validator = $request->validate([       //
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
        
        //勝敗判定となる値の保存
        if($request->match_result == 1){
            $select_pokemon->result = 1;
        }else{
            $select_pokemon->result = 0;
        }
        //試合数を1増やす
        $party->match = ++$party->match;
        $party->save();
        $select_pokemon->save(); //保存部分
        
        //sessionメッセージ
         if ($select3) {
            $messageKey = 'successMessage';
            $flashMessage = '記録しました';
        } else {
            $messageKey = 'errorMessage';
            $flashMessage = '選出したポケモンを3匹選んでください';
        }
        
        $match = $party->match;//総試合数
        //選出率選出のためのデータ
        $pokemons = Party::where('id',$id)->with('pokemons')->get();
        foreach($pokemons as $pokemon_pro){//$pokemonsはコレクションで、$pokemon_proで初めて6匹とのリレーションを持つparty情報になる→したがい、ポケモン1匹ずつの扱いにはもう一回foreachと->'pokemons'が必要
                                                                                                
           foreach($pokemon_pro->pokemons as $pokemon){//$pokemon_はparty情報なので、そこから->することで6匹のポケモン情報が抜け出せる                                                                                      //foreach($p_id as $i){
        
         $count = \App\Models\Select_pokemon::where('first_pokemon_id',$pokemon->id)->where('party_id',$party->id)//party_idとの一致を追加
                                                 ->orWhere('second_pokemon_id',$pokemon->id)->where('party_id',$party->id)
                                                 ->orWhere('third_pokemon_id',$pokemon->id)->where('party_id',$party->id)                                                                                                     //}//選出された回数
                                                 ->count();
        
        if($match ==0){
        $probability = 0;
        }else{
        $probability = intval($count*100/$match);
        }
        $pokemon['probability'] = $probability;//$pokemonに新たに選出率を付随する
        //この時点で、$pokemon_proが$probabilityを付随した$partyになる
        }}
        //dd($pokemon_pro->pokemons);したがい、このデバックでポケモン6匹の$probabilityを付随した情報が得られる
        $pokemon_pro = $pokemon_pro->pokemons;
        
        //partyの勝率を計算する処理
        $win = \App\Models\Select_pokemon::where('result',1)->where('party_id',$party->id)->count();
        if($win ==0){
            $winrate = 0;
        }else{
            $winrate = intval($win*100/$match);
        }
        $party['winrate'] = $winrate;
        
        return redirect()->route('party.show',['party' => $id])->with($messageKey, $flashMessage)
                                                               ->with(['pokemon_pro'=>$pokemon_pro,'party'=>$party]);
                                                              
    
}
}