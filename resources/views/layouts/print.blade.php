<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'W3S Solutions') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- <!-- Styles -->
    <link href="{{ asset('main.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}
    <!-- Scripts -->
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
    <script type="text/javascript">
        window.onload = function() { window.print(); }
       </script>
</head>

<body >
     
            <div id="" class="app-main__outer">
                @yield('content')
                
            </div>
  

</body>

</html>