@extends('bootstrap')

 @section('title','POKEFORM_show')
    @section('content')
        <h1 class="content-title fw-bold">パーティー情報</h1>
        <div class='party_info container px-3 border border-5 rounded-3 border-white'>
            @if(Auth::user()->can('view', $party))
            <div class ="row">
                <h2 class='title fs-1 fw-bold col'>「{{ $party->title }}」</h2>
                <h2 class="col mt-5 offset-8 winrate">勝率 {{$party->winrate}}% 　　　{{$party->win}}勝  {{$party->lose}}敗</h2> </div>
                <p class='body fs-2 text-truncate memo'>{{ $party->content }}</p>
            <div class="party_pokemon container">
                <div class = 'pokemon_list row justify-content-md-center'> 
               
                    @foreach($pokemon_pro as $pokemon_name)
                    
                         <div class = 'pokemon_info col-lg-2 col-md-4 '>
                             <div class="poke mx-auto"> 
                             <p class="mx-auto　pokemon_name fs-4 fw-bold">{{$pokemon_name->jp_name}}</p>
                             <div class="imgarea">
                             <img src="<?php echo $pokemon_name['front_default'] ?>" alt="">
                                    <div class="probability progress-pie-chart"><p class="fw-bold fs-4">{{$pokemon_name->probability}}%</p></div>
                         </div>
                             {{--<div class="type_list row">
                             <h3 class='type fs-5 col text-center mr-3'>{{$pokemon_name->primary_type}}</h3><h3 class="type fs-5 text-center">{{$pokemon_name->secondary_type}}</h3>
                             </div>--}}
                             </div>
                        </div>
                   @endforeach
                  
                  
                </div>
                <div class="row">
                    <div class="show_btn col-3">
             <a href="/parties">戻る</a>
             </div>
              <div class="show_btn col-5 ">
              <a class="btn" data-toggle="modal" data-target="#SelectModal" data-pokemons="{{ $pokemon_pro }}" data-url="{{ route('party.select',['party' => $party,'pokemon_pro' => $pokemon_pro]) }}" >選出率チェッカー</a> 
                </div>
             
                <div class="show_btn col-3 ">
            <div class="edit text-nowrap"><a href="/parties/{{ $party->id }}/edit">編集する</a></div>
            </div>
            @endif
            </div>
            </div>
           
        </div>
                                    {{-- フラッシュメッセージ始まり --}}
                            {{-- 成功の時 --}}
                            @if (session('successMessage'))
                              <div class="alert alert-success text-center">
                                {{ session('successMessage') }}
                              </div> 
                            @endif
                            {{-- 失敗の時 --}}
                            @if (session('errorMessage'))
                              <div class="alert alert-danger text-center">
                                {{ session('errorMessage') }}
                              </div> 
                            @endif
                            {{-- フラッシュメッセージ終わり --}}
        {{-- モーダル部分 --}}
        <div class="modal fade" id="SelectModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <form role="form" class="form-inline modal-lg" method="post" action="">
    @csrf
   
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold" id="myModalLabel">選出率チェッカー</h4>
                </div>
                <div class="modal-body text-mute">
                    <p>選出したポケモンにチェック</p>
                   <div class = 'row justify-content-center'>
                    <div class="match_switch">
                        <label for="switch" class="switch_label">
                            <div class="switch">
                          <input type="checkbox" id="switch" name="match_result" value="1"/>
                          <div class="circle"></div>
                          <div class="slider base"></div>
                              <span class="title-toggle fw-bold text-align-center">負け</span>
                              </div>
                            </label>
                        </div>
                    @foreach($pokemon_pro as $pokemon_img)
                        <div class = 'pokemon_info col-lg-2 col-md-4  mr-2'>
                             <label for="{{$pokemon_img->jp_name}}">
                             <div class="imgarea">
                             <img src="<?php echo $pokemon_img['front_default'] ?>" alt="">
                             </div>
                             <div class="check"> 
                            
                                <input class="col" type="checkbox"  name="select_id[]" value="{{$pokemon_img->id}}" id="{{$pokemon_img->jp_name}}" />
                               {{$pokemon_img->jp_name}}</lavel>
                             </div>
                             
                             
                        </div>
                   
                    @endforeach
                </div>
                <div class="modal-footer">
                    <a class="btn btn-light" data-dismiss="modal">閉じる</a>
                    <button type="submit" class="btn show_btn">記録する</button>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger"><p>3匹チェックしてください</p>
                    @endif
            </div>
        </div>
    </form>
</div>
</div>
      
      <script>
    window.onload = function() {
        $('#SelectModal').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget);//モーダルを呼び出すときに使われたボタンを取得
            var title = button.data('pokemons');//data-titleの値を取得
            var url = button.data('url');//data-urlの値を取得
            var modal = $(this);//モーダルを取得

            //Ajaxの処理はここに
            //modal-bodyのpタグにtextメソッド内を表示
           // modal.find('.modal-body p').eq(0).text("本当に"+title+"を削除しますか?");
            //formタグのaction属性にurlのデータ渡す
            modal.find('form').attr('action',url);
            
            const checkbox = document.getElementById('switch');
            checkbox.addEventListener('click', () => {
              const title = document.querySelector('.title-toggle');
              title.textContent = checkbox.checked ? '勝ち' : '負け';
            });
        });
    }
    
    

</script>
    @endsection