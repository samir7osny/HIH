<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hand In Hand') }}</title>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome-4.7.0/css/font-awesome.css') }}" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
</head>
<body>
    @include('inc.messages')
    @yield('intro')
    @include('inc.navbar')
    @yield('content')
    <script src="{{ asset('js/hih.js') }}"></script>

    <footer>
        <div id="contactus"></div>
        <div id="copyright"></div>
    </footer>
</body>
</html>
