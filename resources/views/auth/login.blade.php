@extends('bootstrap')

 @section('title','POKEFORM_login')
    @section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
<div class = "login-form border border-5 rounded-3 border-white pb-4">
    <div id="login">
       <h1 class="content-title fw-bold">Login Form</h1>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="{{ route('login') }}" method="post">
                            @csrf
                            <h3 class="text-center login-text fw-bold">Login</h3>
                            <div class="form-group">
                                <label for="email" :value="__('Email')" class="login-text">Email:</label><br>
                                <input type="email" name="email" :value="old('email')" required autofocus id="email" class="form-control">
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>
                            <div class="form-group">
                                <label for="password" :value="__('Password')"  class="login-text">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control required autocomplete="current-password"">
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="login-text mt-2"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                               </div> <div class="row"><input type="submit" name="submit" class="btn btn-primary btn-md mt-4 col-2" value="login">
                            <a class="offset-9" href="{{ route('register') }}">登録はこちら</a>
                            
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
