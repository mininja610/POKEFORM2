@extends('bootstrap')

 @section('title','POKEFORM_party')
    @section('content')
        <h1>パーティー登録</h1>
        <div class='party'>
           <form action="/parties" method="POST">
            @csrf
            <input class=hidden type="text" name="party[user_id]" value={{ Auth::user()->id }}>
            <h2>構築名</h2>
                <input type="text" name="party[title]" placeholder="タイトル"　value="{{ old('party.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('party.title') }}</p>
                <div class="body">
                <h2>content</h2>
                <textarea name="party[content]" value="{{ old('party.content') }}"></textarea>
                <p class="title__error" style="color:red">{{ $errors->first('party.content') }}</p>
                </div>
           <div class="party_pokemon">
               <ul id="pokemon_input_list">
                   <h1>ポケモン</h1>
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
            <input type="submit" value="store"/>
        </form>
        </div>
       <div class="footer">
            <a href="/parties">戻る</a>
        
        </div>
   @endsection