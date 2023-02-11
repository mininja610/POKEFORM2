<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeaheadController extends Controller
{
    public function index()
    {
        return view('welcom');
    }
 
    public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = User::where('name', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    } 

}
