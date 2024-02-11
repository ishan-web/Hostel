<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/admincss/boxicons.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/admincss/core.css')}}">

    <link rel="stylesheet" href="{{asset('css/admincss/theme-default.css')}}">

    <link rel="stylesheet" href="{{asset('css/admincss/demo.css')}}">

    <link rel="stylesheet" href="{{asset('css/admincss/perfect-scrollbar.css')}}">

    <link rel="stylesheet" href="{{asset('css/admincss/page-account-settings.css')}}"> 
    
    <link rel="stylesheet" href="{{asset('css/admincss/apex-charts.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/admincss/page-auth.css')}}">

    <link rel="stylesheet" href="{{asset('css/admincss/page-icons.css')}}">

    <link rel="stylesheet" href="{{asset('css/admincss/page-misc.css')}}">

    <script src="{{asset('js/adminjs/helpers.js')}}"></script>

    <script src="{{asset('js/adminjs/config.js')}}"></script>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{asset('js/adminjs/jquery.js')}}"></script>

    <script src="{{asset('js/adminjs/popper.js')}}"></script>

    <script src="{{asset('js/adminjs/bootstrap.js')}}"></script>

    <script src="{{asset('js/adminjs/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('js/adminjs/menu.js')}}"></script> 

    <script src="{{asset('js/adminjs/main.js')}}"></script>

</body>
</html>
