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
                <img src="/storage/usersImages/{{Auth::user()->photo_url}}" alt="">
                <ul>
                    <li><a href="/user/{{Auth::user()->username}}">Profile</a></li>
                    <li><a href="">Message</a></li>
                    <li><a href="">Tasks</a></li>
                    <li><a href="">Requests</a></li>
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
            <li id="active"><a href="/">Home</a></li>
            <li><a href="/committee">Committees</a></li>
            <li><a href="/aboutus">About Us</a></li>
        </ul>
    </nav>
    @if (!Auth::check())
        <div id="backLoginWindow">
            <form id="loginForm" method="POST" class="dark" action="{{ route('login') }}">
                @csrf
                @include('inc.logo')
                <div class="tableCell">
                    <div class="inputContainer">
                        <input type='text' class="requiredInput" name='username' value="{{ old('email') }}" required autofocus>  <label class="" for="username">Username</label>
                    </div>
                    <div class="inputContainer">
                        <input type='password' class="requiredInput" name='password' required>                        
                        <label class="" for="password">Password</label>
                    </div>
                    <div class="inputContainer submitInput">
                        <input type='submit' name='login' value='Login'>
                    </div>
                </div>
            </form>
        </div>
        <script src="{{ asset('js/loginpopup.js') }}"></script>
    @endif
    <script src="{{ asset('js/navbar.js') }}"></script>
</div>