@extends('bootstrap')

 @section('title','POKEFORM_party')
    @section('content')
     <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/vue-simple-suggest"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-simple-suggest/dist/styles.css">
      <div class="content-title">
        <h1 class="fs-1 fw-bold">パーティー登録</h1>
      </div>
        <div class='create-party container px-3 border border-5 rounded-3 border-white'>
           <form action="/parties" method="POST">
            @csrf
            <input type="hidden" class="" name="party[user_id]" value={{ Auth::user()->id }}>
            <h2 class="fs-2 fw-bold create-border">構築名</h2>
                <input type="text" name="party[title]" placeholder="タイトル"　value="{{ old('party.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('party.title') }}</p>
                <div class="body">
                <h2 class="fs-2 fw-bold create-border">content</h2>
                <textarea name="party[content]" value="{{ old('party.content') }}"></textarea>
                <p class="title__error" style="color:red">{{ $errors->first('party.content') }}</p>
                </div>
           <div class="party_pokemon">
               <h1 class="fs-2 fw-bold create-border ">ポケモン</h1>
               <ul id="pokemon_input_list">
                   <div id="app">
                 <vue-simple-suggest 
                      v-model="selected" 
                      :max-suggestions = "802"
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
                      :max-suggestions = "802"
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
                      :max-suggestions = "802"
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
                      :max-suggestions = "802"
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
                      :max-suggestions = "802"
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
                      :max-suggestions = "802"
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
            <div class="row">
                    <div class="show_btn col-2">
             <a href="/parties">戻る</a>
             </div>
                <div class="show_btn col-2 offset-8 mr-2">
            <input type="submit" value="作成する" class="btn-submit "/>
        </form>
         
         <script>
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