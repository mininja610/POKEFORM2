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
        <div class="search">
             <h2 class="text-align-center fw-bold create-border">絞り込み検索</h2>
            <form action="{{ route('history.search') }}" method="GET">
            @csrf
            <div class="history-search d-flex flex-wrap">
                <div class="history-form">
                    <label for="">勝敗
                    <div class="searchbox">
                        <select name="result" data-toggle="select">
                            <option value="" checked>全て</option>
                            <option value="2">負け</option>
                            <option value="1">勝ち</option>
                        </select>
                    </div>
                    </label>
                </div>
                <div class="history-form">
                    <label for="">ルール
                        <div class="searchbox">
                        <select name="format" data-toggle="select">
                            <option value="" checked>全て</option>
                            <option value="1">シングル</option>
                            <option value="2">ダブル</option>
                        </select>
                    </div>
                    </label>
                </div>
                <div class="history-form">
                    <label for="">シーズン
                    <div class="searchbox">
                        <select name="season" data-toggle="select">
                            <option value="">全て</option>
                            <option value="1">シーズン1</option>
                            <option value="2">シーズン2</option>
                            <option value="3">シーズン3</option>
                        </select>
                    </div>
                    </label>
                </div>
                <div class="history-form">
                    <label for="">登録パーティー
                    <div class="searchbox">
                        <select name="party_id" data-toggle="select">
                            <option value="">全て</option>
                           @foreach($parties as $party)
                            <option value="{{$party->id}}">{{$party->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    </label>
                </div>
                </div>
            <div class="row">    
                <div class="search_btn offset-10 col-2">
                    <input type="submit" class="btn-submit btn btn-primary fw-bolder " value="検索">
                </div>
            </div>
        </div>
        </form>
        
            <ul class="list_group py-3">
            @foreach ($histories as $history)
            
            <li class='list_group_item party  py-2'>
                <div class="row">
                    @if($history->result == 1)
                    <h2 class="col-2 win">win</h2>
                    @else
                    <h2 class="col-2 lose">lose</h2>
                    @endif
                    @if ($history->format == 1)
                    <h2 class='title fs-3 fw-bold col-4 col-lg-3 col-xl-2 offset-1 offset-lg-3 offset-xl-5 single'>シングル</h2>
                    @else
                    <h2 class='title fs-3 fw-bold col-4 col-lg-3 col-xl-2 offset-1 offset-lg-3 offset-xl-5 double'>ダブル</h2>
                    @endif

                    <h2 class=' title fs-3 fw-bold col-4 col-lg-3 col-xl-2 offset season '>シーズン{{ $history->season }}</h2>
                    
               </div>
            <div class="row pokemon_img">   
                @foreach($history->pokemons as $pokemon )
                <img class="history-pokemon col-1 " src="<?php echo $pokemon['front_default'] ?>" alt="">
                @endforeach
                    @if($history->party_id == null)
                    <h2 class="offset-1 col-5">使用したパーティー:未登録</h2>
                    @else
                    <h2 class="offset-1 col-5">使用したパーティー:{{$history->party->title}}</h2>
                    @endif
            </div>
            <div><p class="col-12 text-truncate" style="max-width:100%;">{{$history->content}}</p></div>
            </li>
            
            @endforeach
            </ul>
        </div>
    <div class="pagination justify-content-center mt-2">
        @if(count($histories)>0) 
        {{ $histories->links() }}
        @endif
    </div>
     
@endsection