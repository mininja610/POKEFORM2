<!doctype html>
<html >

<head>
    <meta charset='utf-8' />
@vite(['resources/sass/app.scss'])
    <link rel="stylesheet" href="{{ asset('/css/pokeform.css')  }}" >
    
    <title>@yield('title')</title>
     
</head>

<body>

@include('layouts.header_test')

@yield('content')


   

</body>

</html>
