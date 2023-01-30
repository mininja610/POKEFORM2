@extends('bootstrap')

 @section('title','POKEFORM_show')
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
                             <p class="mx-auto">{{$pokemon_name->en_name}}</p>
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
             <a href="/parties">戻る</a>
             </div>
              <div class="show_btn col-5 offset-1">
              <a class="btn" data-toggle="modal" data-target="#SelectModal" data-pokemons="{{ $pokemons_id }}" data-url="{{ route('party.select',['party' => $party,'pokemons_id' => $pokemons_id]) }}" >選出率チェッカー</a> 
                </div>
             
                <div class="show_btn col-3 offset-1">
            <div class="edit text-nowrap"><a href="/parties/{{ $party->id }}/edit">編集する</a></div>
            </div>
            
            </div>
            </div>
            @endif
        </div>
        
        
        
        <div class="modal fade" id="SelectModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    //form-inline:文字の量に合わせてモーダルの大きさが変化する
    <form role="form" class="form-inline" method="post" action="">
    @csrf
   
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold" id="myModalLabel">選出率チェッカー</h4>
                </div>
                <div class="modal-body text-mute">
                    <p>選出したポケモンにチェック</p>
                   <div class = 'row justify-content-center'>
                    @foreach($pokemons_id as $pokemon)
                    @foreach($pokemon->pokemons as $pokemon_img)
                        <div class = 'pokemon_info col-lg-2 col-md-4  mr-2'>
                            <p class="mx-auto">{{$pokemon_img->en_name}}</p>
                             <div class="imgarea">
                             <img src="<?php echo $pokemon_img['front_default'] ?>" alt="">
                             <div class = "probability"></div>
                             </div>
                             <div class="check">
                                 <input class="" type="checkbox"  name="select_id[]" value="{{$pokemon_img->id}}">
                             </div>
                             
                             
                        </div>
                    @endforeach
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
      
      <script>
    window.onload = function() {
        $('#SelectModal').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget);//モーダルを呼び出すときに使われたボタンを取得
            var title = button.data('pokemons_id');//data-titleの値を取得
            var url = button.data('url');//data-urlの値を取得
            var modal = $(this);//モーダルを取得

            //Ajaxの処理はここに
            //modal-bodyのpタグにtextメソッド内を表示
           // modal.find('.modal-body p').eq(0).text("本当に"+title+"を削除しますか?");
            //formタグのaction属性にurlのデータ渡す
            modal.find('form').attr('action',url);
        });
    }
</script>
    @endsection