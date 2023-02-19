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
             <h2 class="create-border fw-bold">絞り込み</h2>
            <form action="{{ route('history.search') }}" method="GET">
            @csrf
            <div class="history-search d-flex flex-wrap">
                <div class="history-form ">
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
                <div class="history-form ">
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
                <div class="history-form ">
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
                <div class="col-2 offset-8 form-btn">
                    <a class="btn-submit btn btn-primary fw-bolder" href="/histories">リセットする</a>
                    </div>
                <div class="show_btn  col-2">
                    <input type="submit" class="btn-submit btn btn-primary fw-bolder" value="検索">
                </div>

            </div>
        </div>
        </form>
        @if (!empty($search_results))

        
            <ul class="list_group py-3">
            @foreach ($search_results as $result)
            
            <li class='list_group_item party  py-2'>
                <div class="row">
                    @if($result->result == 1)
                    <h2 class="col-2 win">win</h2>
                    @else
                    <h2 class="col-2 lose">lose</h2>
                    @endif
                    @if ($result->format == 1)
                    <h2 class='title fs-3 fw-bold col-4 col-lg-3 col-xl-2 offset-1 offset-lg-3 offset-xl-5 single'>シングル</h2>
                    @else
                    <h2 class='title fs-3 fw-bold col-4 col-lg-3 col-xl-2 offset-1 offset-lg-3 offset-xl-5 double'>ダブル</h2>
                    @endif

                    <h2 class=' title fs-3 fw-bold col-4 col-lg-3 col-xl-2 offset season '>シーズン{{ $result->season }}</h2>
                    
               </div>
            <div class="row pokemon_img">   
                @foreach($result->pokemons as $pokemon )
                <img class="history-pokemon col-1 " src="<?php echo $pokemon['front_default'] ?>" alt="">
                @endforeach
                    @if($result->party_id == null)
                    <h2 class="offset-1 col-5">使用したパーティー:未登録</h2>
                    @else
                    <h2 class="offset-1 col-5">使用したパーティー:{{$result->party->title}}</h2>
                    @endif
            </div>  
                <div><p class="col-12 text-truncate" style="max-width:100%;">{{$result->content}}</p></div>
            </li>
            
            @endforeach
            </ul>
        </div>
    @else
        <div class='parties container px-3 border border-5 rounded-3 border-white'>
            <h2>戦闘履歴がありません</h2>
        </div>
    @endif
    <div class="pagination justify-content-center mt-2">
        @if(count($search_results)>0) 
        {{ $search_results->links() }}
        @endif
    </div>
    
@endsection