@extends('bootstrap')

 @section('title','POKEFORM_party')
    @section('content')
    
      <div class="content-title">
        <h1 class="fs-1 fw-bold">パーティー登録</h1>
      </div>
        <div class='create-party container px-3 border border-5 rounded-3 border-white'>
           <form action="/parties" method="POST">
            @csrf
            <input type="hidden" class="" name="party[user_id]" value={{ Auth::user()->id }}>
            <h2 class="fs-2 fw-bold create-border">構築名</h2>
                <input type="text" name="party[title]" placeholder="タイトル"　value="{{ old('party.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('party.title') }}</p>
                <div class="body">
                <h2 class="fs-2 fw-bold create-border">content</h2>
                <textarea name="party[content]" value="{{ old('party.content') }}"></textarea>
                <p class="title__error" style="color:red">{{ $errors->first('party.content') }}</p>
                </div>
           <div class="party_pokemon">
               <h1 class="fs-2 fw-bold create-border ">ポケモン</h1>
               <ul id="pokemon_input_list">
                   
               <li class = input_list>
                   <input id="p1" name="p1" type="text" placeholder="ポケモン名" value="{{ old('p1') }}">
               </li>
               <li class = input_list>
                   <input id="p2" name="p2" type="text" placeholder="ポケモン名" value="{{ old('p2') }}">
               </li>
               <li class = input_list>
                   <input id="p3" name="p3" type="text" placeholder="ポケモン名" value="{{ old('p3') }}">
               </li>
               <li class = input_list>
                   <input id="p4" name="p4" type="text" placeholder="ポケモン名" value="{{ old('p4') }}">
               </li>
               <li class = input_list>
                   <input id="p5" name="p5" type="text" placeholder="ポケモン名" value="{{ old('p5') }}">
               </li>
               <li class = input_list>
                   <input id="p6" name="p6" type="text" placeholder="ポケモン名" value="{{ old('p6') }}">
               </li>
               </ul>
               <p class="title__error" style="color:red">{{ $errors->first('p1') }}</p>
            </div>
            <div class="row">
                    <div class="show_btn col-2">
             <a href="/parties">戻る</a>
             </div>
                <div class="show_btn col-2 offset-8 mr-2">
            <input type="submit" value="作成する" class="btn-submit "/>
        </form>
        </div>
        
   @endsection