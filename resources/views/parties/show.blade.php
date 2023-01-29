@extends('bootstrap')

 @section('title','POKEFORM_party')
    @section('content')
        <h1>パーティー情報</h1>
        <div class='party_info'>
            @if(Auth::user()->can('view', $party))
            
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
            <div class="edit"><a href="/parties/{{ $party->id }}/edit">編集する</a></div>
            </div>
            @endif
        </div>
       <div class="footer">
            <a href="/parties">戻る</a>
        
        </div>
    @endsection