@extends('bootstrap')
  
    @section('title','POKEFORM_welcome')
    @section('content')
    <div class="welcome-page border border-5 rounded-3 border-white">
    <div class="content-title">
        <h1 class="fs-1 fw-bold">POKEFORMへようこそ</h1>
      </div>
               <div class="row mb-2">
                <div class="col-md-6">
                  <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                      <strong class="d-inline-block mb-2 text-primary fs-2">パーティー管理</strong>
                      <h3 class="mb-0">
                       
                      </h3>
                      <div class="mb-1 fs-4">自分のパーティーを登録しよう</div>
                      <p class="card-text mb-auto">登録したパーティーの勝敗、各ポケモンの選出率の記録を付けることができます</p>
                     <a href="{{ route('login') }}" class="btn btn-outline-primary welcome-btn">ログインして利用を開始する</a>
                       
                    </div>
                    <img class="card-img-right flex-auto d-none d-lg-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="{{ asset('images/welcome_party2.jpg')}}" data-holder-rendered="true">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                      <strong class="d-inline-block mb-2 text-success fs-2">対戦履歴管理</strong>
                      <h3 class="mb-0">
                       
                      </h3>
                      <div class="mb-1 fs-4">対戦したパーティーを記録しよう</div>
                      <p class="card-text mb-auto">戦ったパーティーと勝敗、その際のメモを保存することができます</p>
                      <a href="{{ route('login') }}" class="btn btn-outline-success welcome-btn">ログインして利用を開始する</a>
                    </div>
                    <img class="card-img-right flex-auto d-none d-lg-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" src="dm%3E" data-holder-rendered="true" style="width: 200px; height: 250px;">
                  </div>
                </div>
              </div>
              <div class="p-3 mb-3 bg-light rounded">
        <a class="font-italic fw-bold fs-3 text-black">まだ登録していない方は</a><a href="{{ route('register') }}" class="font-italic fw-bold fs-3">こちら</a>
        
                
                

        </div>
    </div>
 @endsection
