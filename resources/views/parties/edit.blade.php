<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <x-slot name="header">
        　パーティー管理
    </x-slot>
    <body>
        <h1>パーティー編集</h1>
        <div class='party'>
           <form action="/parties/{{$party->id}}" method="POST">
            @csrf
            @method('PUT')
            <input class=hidden type="text" name="party[user_id]" value={{ Auth::user()->id }}>
            <h2>構築名</h2>
                <input type="text" name="party[title]" value="{{$party->title}}"/>
                <p class="title__error" style="color:red">{{ $errors->first('party.title') }}</p>
                <div class="body">
                <h2>content</h2>
                <textarea name="party[content]" value="{{$party->content}}"></textarea>
                <p class="title__error" style="color:red">{{ $errors->first('party.content') }}</p>
            </div>
           <div class="party_pokemon">
                <h3>ポケモン</h3>
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
            <input type="submit" value="保存する"/>
        </form>
        </div>
       <div class="footer">
            <a href="/parties">戻る</a>
        
        </div>
    </body>
    </x-app-layout>
</html>