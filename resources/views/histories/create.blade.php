@extends('bootstrap')

 @section('title','POKEFORM_histort_create')
    @section('content')
     <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/vue-simple-suggest"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-simple-suggest/dist/styles.css">
      <div class="content-title">
        <h1 class="fs-1 fw-bold">対戦履歴登録</h1>
      </div>
        <div class='create-party container px-3 border border-5 rounded-3 border-white'>
           <form action="/histories" method="POST">
            @csrf
            <input type="hidden" class="" name="history[user_id]" value={{ Auth::user()->id }}>
                <div class="row"> 
                
                    <label for="switch" class="switch_label">
                            <div class="switch">
                          <input type="checkbox" id="switch" name="history[result]" value="1"/>
                          <div class="circle"></div>
                          <div class="slider base"></div>
                              <span class="title-toggle fw-bold text-align-center" id="text">負け</span>
                              </div>
                    </label>
                    <div class="form-group mt-1">
                            <div class="form-check-inline">
                              <input class="form-check-input custom" type="radio" id="inlineCheckbox1" name="history[format]" checked value="1">
                              <label class="form-check-label" for="inlineCheckbox1">シングル</label>
                            </div>
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox2" name="history[format]" value="2">
                              <label class="form-check-label" for="inlineCheckbox2">ダブル</label>
                            </div>
                    </div>
                    <div class="form-group mt-1">
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox1" name="history[season]" value="1">
                              <label class="form-check-label" for="inlineCheckbox1">シリーズ1</label>
                            </div>
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox2" name="history[season]" value="2" checked>
                              <label class="form-check-label" for="inlineCheckbox2">シリーズ2</label>
                            </div>
                            <div class="form-check-inline">
                              <input class="form-check-input" type="radio" id="inlineCheckbox3" name="history[season]" value="3">
                              <label class="form-check-label" for="inlineCheckbox3">シリーズ3</label>
                            </div>
                    </div>
                    <div class="form-group w-25 mt-1">
                    <label for="category-id ">{{ __('使用した登録パーティー') }}</label>
                    <select class="form-control" id="party-id" name="history[party_id]">
                       
                            <option value="">登録しない</option>
                            @foreach($parties as $party)
                            <option value="{{$party->id}}" name="history[party_id]">{{$party->title}}</option>
                            @endforeach
                    </select>
                  </div>
                </div>
               
           <div class="party_pokemon">
               <h1 class="fs-2 fw-bold create-border ">ポケモン</h1>
                <div id="app">
                 <vue-simple-suggest 
                      v-model="selected" 
                      :max-suggestions = "890"
                      :min-length = "2"
                      :list="suggestionList" 
                      :filter-by-query="true">
               <li class = input_list>
                 <input  id="p1" name="p1" type="text" placeholder="ポケモン名" value="{{ old('p1') }}"> 
                  </vue-simple-suggest>
                    </div>
               </li>
               <li class = input_list>
                   <div id="app1">
                 <vue-simple-suggest 
                      v-model="selected" 
                      :max-suggestions = "890"
                      :min-length = "2"
                      :list="suggestionList" 
                      :filter-by-query="true">
                   <input id="p2" name="p2" type="text" placeholder="ポケモン名" value="{{ old('p2') }}">
                    </vue-simple-suggest>
                    </div>
               </li>
               <li class = input_list>
                    <div id="app2">
                 <vue-simple-suggest 
                      v-model="selected" 
                      :max-suggestions = "890"
                      :min-length = "2"
                      :list="suggestionList" 
                      :filter-by-query="true">
                   <input id="p3" name="p3" type="text" placeholder="ポケモン名" value="{{ old('p3') }}">
                    </vue-simple-suggest>
                    </div>
               </li>
               <li class = input_list>
                    <div id="app3">
                 <vue-simple-suggest 
                      v-model="selected" 
                      :max-suggestions = "890"
                      :min-length = "2"
                      :list="suggestionList" 
                      :filter-by-query="true">
                   <input id="p4" name="p4" type="text" placeholder="ポケモン名" value="{{ old('p4') }}">
                    </vue-simple-suggest>
                    </div>
               </li>
               <li class = input_list>
                    <div id="app4">
                 <vue-simple-suggest 
                      v-model="selected" 
                      :max-suggestions = "890"
                      :min-length = "2"
                      :list="suggestionList" 
                      :filter-by-query="true">
                   <input id="p5" name="p5" type="text" placeholder="ポケモン名" value="{{ old('p5') }}">
                    </vue-simple-suggest>
                    </div>
               </li>
               <li class = input_list>
                    <div id="app5">
                 <vue-simple-suggest 
                      v-model="selected" 
                      :max-suggestions = "890"
                      :min-length = "2"
                      :list="suggestionList" 
                      :filter-by-query="true">
                   <input id="p6" name="p6" type="text" placeholder="ポケモン名" value="{{ old('p6') }}">
                    </vue-simple-suggest>
                    </div>
               </li>
               </ul>
               
               <p class="title__error" style="color:red">{{ $errors->first('p1') }}</p>
            </div>
             <h2 class="fs-2 fw-bold create-border">メモ</h2>
              <div class="body">
               
                <textarea name="history[content]" value="{{ old('history.content') }}" class="w-100"></textarea>
                <p class="title__error" style="color:red">{{ $errors->first('history.content') }}</p>
                </div>
            <div class="row">
                    <div class="show_btn col-2">
             <a href="/histories">戻る</a>
             </div>
                <div class="show_btn col-2 offset-8 mr-2">
            <input type="submit" value="記録する" class="btn-submit "/>
        </form>
        </div>
        
    <script>

        
        const checkbox = document.getElementById('switch');
            checkbox.addEventListener('click', () => {
              const title = document.querySelector('.title-toggle');
              title.textContent = checkbox.checked ? '勝ち' : '負け';
            });
            
        
  const app = new Vue({
    el: '#app',
    data: {
      selected: null,
      suggestionList: ['Canada', 'China', 'Cameroon', "Italy", "Iraq", "Iceland"]
    }, mounted(){
        axios.get('/autocomplete-search')
            .then(response => this.suggestionList = response.data)
            .catch(error => console.log(error))
    }
   
  })
   const app1 = new Vue({
    el: '#app1',
    data: {
      selected: null,
      suggestionList: ['Canada', 'China', 'Cameroon', "Italy", "Iraq", "Iceland"]
    }, mounted(){
        axios.get('/autocomplete-search')
            .then(response => this.suggestionList = response.data)
            .catch(error => console.log(error))
    }
   
  })
 
  const app2 = new Vue({
    el: '#app2',
    data: {
      selected: null,
      suggestionList: ['Canada', 'China', 'Cameroon', "Italy", "Iraq", "Iceland"]
    }, mounted(){
        axios.get('/autocomplete-search')
            .then(response => this.suggestionList = response.data)
            .catch(error => console.log(error))
    }
   
  })
   const app3 = new Vue({
    el: '#app3',
    data: {
      selected: null,
      suggestionList: ['Canada', 'China', 'Cameroon', "Italy", "Iraq", "Iceland"]
    }, mounted(){
        axios.get('/autocomplete-search')
            .then(response => this.suggestionList = response.data)
            .catch(error => console.log(error))
    }
   
  })
   const app4 = new Vue({
    el: '#app4',
    data: {
      selected: null,
      suggestionList: ['Canada', 'China', 'Cameroon', "Italy", "Iraq", "Iceland"]
    }, mounted(){
        axios.get('/autocomplete-search')
            .then(response => this.suggestionList = response.data)
            .catch(error => console.log(error))
    }
   
  })
   const app5 = new Vue({
    el: '#app5',
    data: {
      selected: null,
      suggestionList: ['Canada', 'China', 'Cameroon', "Italy", "Iraq", "Iceland"]
    }, mounted(){
        axios.get('/autocomplete-search')
            .then(response => this.suggestionList = response.data)
            .catch(error => console.log(error))
    }
   
  })

    </script>
   @endsection