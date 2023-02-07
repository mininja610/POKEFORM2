<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Pokemon;
use App\Models\History;

class HistoryController extends Controller
{
    public function history(History $history)
    {   $id = Auth::user ()->id;
        $histories = History::where('user_id',$id)->get();
        
        //dd($histories);
        //return back;
       return view('histories/history')->with(['histories' => $histories]);  
      
    }
        public function create()
    {
        return view('histories/create');  
      
    }
    public function store(Request $request, History $history)
    {
        $input_history = $request['history'];
        $history->fill($input_history)->save();
        
        $input_pokemons = \App\Models\Pokemon::whereIn('jp_name',[$request->p1,$request->p2,$request->p3,$request->p4,$request->p5,$request->p6])->get();
       //送られた名前のポケモンの配列を作成してid値のみ取得
        $pokemon_id = $input_pokemons->pluck('id')->all();  
        
        //  中間テーブルに保存
        $history->pokemons()->attach($pokemon_id);
        
        // historyへ渡すデータ
        $id = Auth::user ()->id;
        $histories = History::where('user_id',$id)->with('pokemons')->paginate(5);
        
        
        
        
        
        
        return view('histories/history')->with(['histories' => $histories,'pokemons' => $pokemons]);  
      
    }
}
