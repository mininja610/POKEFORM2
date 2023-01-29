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
        <h1>パーティー情報</h1>
        <div class='party'>
            @if(Auth::user()->can('view', $party))
            <div class='party'>
                <h2 class='title'>{{ $party->title }}</h2>
                <p class='body'>{{ $party->content }}</p>
            <div class="party_pokemon">
                <h3>ポケモン</h3>
                <ul id = 'pokemon_list'>
                    @foreach($pokemons_id as $pokemon)
                    @foreach($pokemon->pokemons as $pokemon_name)
                         <li class = 'pokemon'>
                             
                             <p>{{$pokemon_name->name}}</p><h3 class='type_list'>{{$pokemon_name->primary_type}},{{$pokemon_name->secondary_type}}</h3>
                        </li>
                   @endforeach
                   @endforeach
                </ul>    
            </div>
            <div class="edit"><a href="/parties/{{ $party->id }}/edit">編集する</a></div>
            </div>
            @endif
        </div>
       <div class="footer">
            <a href="/parties">戻る</a>
        
        </div>
    </body>
    </x-app-layout>
</html>