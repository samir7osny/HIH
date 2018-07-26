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
        <div id="contactus">
            <div class="container">
                    {!! Form::open(['action' => 'ContactUsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'feedback']) !!}
                        <h1>Contact Us</h1>
                        <input required type="text" placeholder="Enter your name" name="sender_name">
                        <input required type="email" placeholder="Enter your email" name="sender_email">
                        <textarea required placeholder="Enter your message" name="content"></textarea>
                        <input type="submit" value="Submit">
                    {!! Form::close() !!}
                    <div class="sponsors">
                        @if (\App\HIH::first() && \App\HIH::first()->Sponsors())
                            @foreach(\App\HIH::first()->Sponsors() as $sponsor)
                            <div style="height:148px;width:148px; float:left; margin: 10px;">
                                <a target="blank" href="/sponsor/{{$sponsor->sponsor->id}}" class="member">
                                    <img src="{{asset('/storage/sponsorsImages/'.$sponsor->sponsor->photo_url)}}"/>
                                </a>
                            </div>  
                            @endforeach
                        @endif
                    </div>
            </div>
        </div>
        <div id="copyright">
            <a href="https://www.facebook.com/HIH.CUFE"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
            <a href="https://www.linkedin.com/in/hand-in-hand-cufe-90739512a"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
            <a href="https://www.instagram.com/hih_cufe/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </div>
    </footer>
</body>
</html>
