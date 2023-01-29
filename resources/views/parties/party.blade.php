@extends('bootstrap')
  
    @section('title','POKEFORM_party')
    @section('content')
        
        <div class='create d-grid gap-2 col-4 mx-auto py-5'>
            <a href='parties/create' class="btn fs-3 create_btn fw-bolder">Create party</a>
        </div>
        <h1>パーティ一覧</h1>
        <div class='parties container px-3 border border-5 rounded-3 border-white'>
            <ul class="list_group">
            @foreach ($parties as $party)
            @if(Auth::user()->can('view', $party))
            <li class='list_group_item party row py-2'>
                <h2 class='title fs-3 fw-bold col-2 '>「{{ $party->title }}」</h2>
                <p class='col-3 text-truncate d-inline-block' style="max-width: 1000px;">{{ $party->content }}</p>
                <div class="show_btn col-2 offset-3">
                <a href="/parties/{{ $party->id }}" class="fw-bolder">確認する</a>
                </div>
            <form action="/parties/{{ $party->id }}" id="form_{{ $party->id }}" method="post" class="col-2">
             @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{ $party->id }})" class="">削除する</button> 
            </form>
            </li>
            @endif
            @endforeach
            </ul>
        </div>
        <div class='paginate'>
           
        </div>
        <script>
    function deletePost(id) {
        'use strict'

        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        }
    }
@endsection

