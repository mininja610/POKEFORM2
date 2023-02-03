<header class="blog-header">
  <div class="container  w-100 pokeform pb-3">
        <div class="d-flex align-items-center justify-content-center">
          <img src="{{ asset('images/pokeform_logo.jpg')}}" class="w-75 ">
        </div>  
       <form method="POST" action="{{ route('logout') }}" class="row">
        @csrf
        <button class="btn btn-lg btn-outline-secondary btn-block offset-11 col-1 fw-bold logout-btn" type="submit">logout</button>
        </form>    
        </div>
      
      <ul class="menu_list py-2">
    <li class="menu fs-4 fw-bolder"><a href="/parties">パーティー管理</a></li>
    {{--<li class="menu fs-4 fw-bolder"><a href="">ダメージ計算</a></li>  
    <li class="menu fs-4 fw-bolder"><a href="">ランキング</a></li>--}}
    <li class="menu fs-4 fw-bolder"><a href="">対戦履歴管理</a></li>
      </ul>
      
      </header>