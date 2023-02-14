@extends('bootstrap')
  
    @section('title','POKEFORM_party')
    @section('content')
        
        <div class='create d-grid gap-2 col-6 mx-auto py-5'>
            <a href='parties/create' class="btn fs-3 create_btn fw-bolder">新しいパーティーを作成する</a>
        </div>
        <div class='content-title'>
        <h1 class="fs-1 fw-bold">パーティ一覧</h1>
        </div>
        <div class='parties container px-3 border border-5 rounded-3 border-white'>
            <ul class="list_group">
            @foreach ($parties as $party)
            @if(Auth::user()->can('view', $party))
            <li class='list_group_item party row py-2'>
                <h2 class='title fs-3 fw-bold col-xl-2 col-sm-3 text-truncate'>「{{ $party->title }}」</h2>
                <p class='col-2 text-truncate d-inline-block' style="max-width: 1000px;">{{ $party->content }}</p>
                <div class="show_btn col-xl-2 col-sm-3 offset-xl-3">
                <a href="/parties/{{ $party->id }}" class="fw-bolder col">確認する</a>
                </div>
                <div class="col-xl-2 offset-xl-1">
                <a class="btn btn-danger" data-toggle="modal" data-target="#PartyModal" data-title="{{ $party->title }}" data-url="{{ route('party.delete',['party' => $party]) }}" >削除する</a> 
                </div>
           
            </li>
            @endif
            @endforeach
            </ul>
        </div>
        <div class="pagination">            
      @if(count($parties)>5) 
      {{ $parties->links() }}
      @endif
        </div>



       <div class="modal fade" id="PartyModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    //form-inline:文字の量に合わせてモーダルの大きさが変化する
    <form role="form" class="form-inline" method="post" action="">
    @csrf
    @method('DELETE')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">削除確認</h4>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-light" data-dismiss="modal">閉じる</a>
                    <button type="submit" class="btn btn-danger">削除</button>
                </div>
            </div>
        </div>
    </form>
</div>
       

     <script>
    window.onload = function() {
        $('#PartyModal').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget);//モーダルを呼び出すときに使われたボタンを取得
            var title = button.data('title');//data-titleの値を取得
            var url = button.data('url');//data-urlの値を取得
            var modal = $(this);//モーダルを取得

            //Ajaxの処理はここに
            //modal-bodyのpタグにtextメソッド内を表示
            modal.find('.modal-body p').eq(0).text("本当に"+title+"を削除しますか?");
            //formタグのaction属性にurlのデータ渡す
            modal.find('form').attr('action',url);
        });
    }
</script>  

      
@endsection

