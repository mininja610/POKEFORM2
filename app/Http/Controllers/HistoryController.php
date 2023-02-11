<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Pokemon;
use App\Models\History;
use App\Models\Party;

class HistoryController extends Controller
{
    public function history(History $history)
    {   $id = Auth::user ()->id;
        $histories = History::where('user_id',$id)->paginate(5);
        $parties = \App\Models\Party::where('user_id',$id)->get();
        
        
       return view('histories/history')->with(['histories' => $histories,'parties' => $parties]);  
      
    }
        public function create()
    {   
        $id = Auth::user ()->id;
        $parties = \App\Models\Party::where('user_id',$id)->get();
        return view('histories/create')->with(["parties" => $parties]);  
      
    }
    public function store(Request $request, History $history)
    {
        $input_history = $request['history'];
        
        $history->fill($input_history)->save();
        if ($history->result != 1) {
            $history->result = 2;
            $history->save();
        }
        
        $input_pokemons = \App\Models\Pokemon::whereIn('jp_name',[$request->p1,$request->p2,$request->p3,$request->p4,$request->p5,$request->p6])->get();
       //送られた名前のポケモンの配列を作成してid値のみ取得
        $pokemon_id = $input_pokemons->pluck('id')->all();  
        
        //  中間テーブルに保存
        $history->pokemons()->attach($pokemon_id);
        
        // historyへ渡すデータ
        $id = Auth::user ()->id;
        $histories = History::where('user_id',$id)->with('pokemons')->paginate(5);
        $parties = \App\Models\Party::where('user_id',$id)->get();

        return view('histories/history')->with(['histories' => $histories,'parties' => $parties]);  
      
    }
    public function search(Request $request, History $history){
        $id = Auth::user ()->id;
        $result = $request->result;
        $format = $request->format;
        $season = $request->season;
        $p_id = $request->party_id;
        
        $query = History::query()->with('pokemons');
        
            $query->where('user_id',$id);
        if (isset($result)) {
            $query->where('result', $result);
        }
        if (isset($format)) {
            $query->where('format', $format);
        }
        if (isset($season)) {
            $query->where('season', $season);
        }
        if (isset($p_id)) {
            $query->where('party_id', $p_id);
        }
        
        $search_results = $query->orderBy('id', 'desc')->paginate(5);
         $id = Auth::user ()->id;
         $parties = \App\Models\Party::where('user_id',$id)->get();
        return view('histories/search')->with(['search_results' => $search_results, 'parties' => $parties]);
        
       // dd($search_results);
        
        //return back;
    }
    public function search_email(Request $request)
    {
        $searchquery = $request->input('query');
        $data = Pokemon::where('jp_name', 'like', '%' . $searchquery . '%')->limit(10)->get();
        return response()->json($data);
    }

}
