@extends('bootstrap')

 @section('title','POKEFORM_history')
    @section('content')
    
            
        <div class='create d-grid gap-2 col-6 mx-auto py-5'>
            <a href='histories/create' class="btn fs-3 create_btn fw-bolder">新しい対戦履歴を付ける</a>
        </div>
        <div class='content-title'>
        <h1 class="fs-1 fw-bold">対戦履歴</h1>
        </div>
        <div class='parties container px-3 border border-5 rounded-3 border-white'>
            <ul class="list_group">
            @foreach ($histories as $history)
            
            <li class='list_group_item party  py-2'>
                <div class="row">
                    @if ($history->format == 1)
                    <h2 class='title fs-3 fw-bold col-2 offset-5 single'>シングル</h2>
                    @else
                    <h2 class='title fs-3 fw-bold col-2 double'>ダブル</h2>
                    @endif

                    <h2 class=' title fs-3 fw-bold col-2 mr-2 season '>シーズン{{ $history->season }}</h2>
                    <p class="col-2">{{$history->content}}</p>
               </div>
               
                @foreach($history->pokemons as $pokemon )
                <img class="history-pokemon " src="<?php echo $pokemon['front_default'] ?>" alt="">
                @endforeach
                
            
            </li>
            
            @endforeach
            </ul>
        </div>
    
    
    
    
@endsection