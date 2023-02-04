@extends('bootstrap')

 @section('title','POKEFORM_select')
    @section('content')
        <h1 class="content-title fw-bold">パーティー情報</h1>
        <div class='party_info container px-3 border border-5 rounded-3 border-white'>
            @if(Auth::user()->can('view', $party))
            
                <h2 class='title fs-1 fw-bold'>「{{ $party->title }}」</h2>
                <p class='body fs-2 text-truncate'>{{ $party->content }}</p>
            <div class="party_pokemon container">
                <div class = 'pokemon_list row justify-content-md-center'>
                    @foreach($pokemons_id as $pokemon)
                    @foreach($pokemon->pokemons as $pokemon_name)
                         <div class = 'pokemon_info col-lg-2 col-md-4 '>
                             <div class="poke mx-auto"> 
                             <p class="mx-auto">{{$pokemon_name->jp_name}}</p>
                             <div class="imgarea">
                             <img src="<?php echo $pokemon_name['front_default'] ?>" alt="">
                             </div>
                             <div class="type_list row">
                             <h3 class='type fs-5 col text-left'>{{$pokemon_name->primary_type}}</h3><h3 class="type fs-5 text-left">{{$pokemon_name->secondary_type}}</h3>
                             </div>
                             </div>
                        </div>
                   @endforeach
                   @endforeach
                </div>
                <div class="row">
                    <div class="show_btn col-2">
             <a href="/parties/{{ $party->id }}">戻る</a>
             </div>
              
             
                <div class="show_btn col-4 offset-6 mr-2">
            <div class="edit text-nowrap"><a href="/parties/{{ $party->id }}/edit">記録を付ける</a></div>
            </div>
            
            </div>
            </div>
            @endif
        </div>
      
    @endsection