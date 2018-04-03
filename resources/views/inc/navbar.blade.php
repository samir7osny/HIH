<div id="navContainer">
    <nav id="mainNav">
        <div class="logo">
            <a href="/home">
                @include('inc.logo')
            </a>
        </div>
        <div id="menuButton" case='closed'>
            <span></span>
            <span></span>
            <span></span>
        </div>
        @if (Auth::check())
            <div id="user">
                <img src="{{ asset('images/temp/tomhanks.jpg') }}" alt="">
                <ul style="height:0%">
                    <li>Profile</li>
                    <li>Message</li>
                    <li>Tasks</li>
                    <li>Requests</li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form></li>
                </ul>
            </div>
        @else
            <div id="user">
                <i onclick="openLoginForm()" class="fa fa-sign-in" aria-hidden="true"></i>
            </div>
        @endif
        <ul>
            <li id="active">Home</li>
            <li><a href="committee">Committees</a></li>
            <li>Google</li>
        </ul>
    </nav>
    <div id="backLoginWindow">
        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf
            <input type='text' name='username' placeholder='Username' value="{{ old('email') }}" required autofocus>
            @if ($errors->has('username'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
            <input type='password' name='password' placeholder='Password' required>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <input type='submit' name='login' value='Login'>
        </form>
    </div>
    <script src="{{ asset('js/loginpopup.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
</div>