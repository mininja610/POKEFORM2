@extends('bootstrap')

 @section('title','POKEFORM_login')
    @section('content')
    <!-- Session Status -->
<div class = "login-form border border-5 rounded-3 border-white pb-4">
    <div id="login">
       <h1 class="content-title fw-bold">Register Form</h1>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="{{ route('register') }}" method="post">
                            @csrf
                            <h3 class="text-center login-text fw-bold">Register</h3>
                            <div class="form-group">
                                <label for="name" :value="__('Name')" class="login-text">Name:</label><br>
                                <input id="name" type="text" name="name" :value="old('name')" required autofocus class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" :value="__('Email')" class="login-text">Email:</label><br>
                                <input type="email" name="email" :value="old('email')" required  id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" :value="__('Password')"  class="login-text">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control required autocomplete="new-password"">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                             <!-- Confirm Password -->
                            <div class="form-group">
                                <label for="password_confirmation" :value="__('Confirm Password')" class="login-text mt-2">Confirm Password:</label><br>
                                <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control"><br>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                               </div> 
                              <input type="submit" name="submit" class="btn btn-primary btn-md mt-4 col-2" value="register">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div> 
@endsection
