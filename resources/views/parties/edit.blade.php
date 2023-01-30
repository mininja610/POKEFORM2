@extends('bootstrap')
  
    @section('title','POKEFORM_party_edit')
    @section('content')
        <h1 class="content-title fw-bold">パーティー編集</h1>
        <div class='edit-party container px-3 border border-5 rounded-3 border-white'>
           <form action="/parties/{{$party->id}}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="party[user_id]" value={{ Auth::user()->id }}>
            <h2 class="fs-2 fw-bold create-border">構築名</h2>
                <input type="text" name="party[title]" value="{{$party->title}}"/>
                <p class="title__error" style="color:red">{{ $errors->first('party.title') }}</p>
                <div class="body">
                <h2 class="fs-2 fw-bold create-border">content</h2>
                <textarea name="party[content]" value="{{$party->content}}"></textarea>
                <p class="title__error" style="color:red">{{ $errors->first('party.content') }}</p>
            </div>
           <div class="party_pokemon">
                <h3 class="fs-2 fw-bold create-border">ポケモン</h3>
            <ul id = 'pokemon_list'>
               <li class = input_list>
                   <input id="p1" name="p1" type="text" value="{{$name[0]}}">
               </li>
               <li class = input_list>
                   <input id="p2" name="p2" type="text" value="{{$name[1]}}">
               </li>
               <li class = input_list>
                   <input id="p3" name="p3" type="text" value="{{$name[2]}}">
               </li>
               <li class = input_list>
                   <input id="p4" name="p4" type="text" value="{{$name[3]}}">
               </li>
               <li class = input_list>
                   <input id="p5" name="p5" type="text" value="{{$name[4]}}">
               </li>
               <li class = input_list>
                   <input id="p6" name="p6" type="text" value="{{$name[5]}}">
               </li>
            </ul>    
            </div>
            <div class="row">
                    <div class="show_btn col-2">
             <a href="/parties">戻る</a>
             </div>
                <div class="show_btn col-2 offset-8 mr-2">
            <input type="submit" value="保存する" class="btn-submit "/>
        </form>
        </div>
    @endsection