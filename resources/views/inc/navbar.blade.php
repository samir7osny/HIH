@if (!Auth::check() && Request::path() != 'login')
    <div id="backLoginWindow">
        <form id="loginForm" method="POST" class="dark" action="{{ route('login') }}">
            @csrf
            @include('inc.logo')
            <div class="tableCell">
                <div class="inputContainer">
                    <input type='text' class="requiredInput" name='username' value="{{ old('username') }}" required autofocus>  <label class="" for="username">Username</label>
                </div>
                <div class="inputContainer">
                    <input type='password' class="requiredInput" name='password' required>                        
                    <label class="" for="password">Password</label>
                </div>
                <div class="inputContainer">
                        <input hidden id="remembermeInput" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="checkmark" onclick="$('#remembermeInput').click()"></span>
                        <label id="remembermeDiv" onclick="$('#remembermeInput').click()" for="remember">Remember Me</label>
                </div>
                <div class="inputContainer submitInput">
                    <input type='submit' name='login' value='Login'>
                </div>

                <a href="/user/create" style="color:#BBB;text-decoration:underline;">Don't have account?</a>
                <a id="forgotPassword" href="{{ route('password.request') }}"><i class="fa fa-meh-o" aria-hidden="true"></i><span>Forgot Your Password?</span></a>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/loginpopup.js') }}"></script>
@endif
<div id="navContainer">
    <nav id="mainNav">
        <div class="logo">
            <a href="/">
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
                    <li><a href="/chat">Message</a></li>
                    @if (\App\User::havePermission(['PRESIDENT','TYPE_HEAD','HR']))
                    <li><a href="/task">Tasks</a></li>
                    @endif
                    @if (\App\User::havePermission(['PRESIDENT','TYPE_HEAD','HR']))
                    <li><a href="/request">Requests</a></li>
                    @endif
                    @if (\App\User::havePermission(['PRESIDENT','HIGHBOARD','BOARD']))
                    <li><a href="/contactus">Feedback</a></li>
                    @endif
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form></li>
                </ul>
            </div>
        @elseif (Request::path() != 'login')
            <div id="user">
                <i onclick="openLoginForm()" class="fa fa-sign-in" aria-hidden="true"></i>
            </div>
        @endif
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/committee">Committees</a></li>
            <li class="hasDropdown">Activities
                <ul>
                    <li><a href="/event">Events</a></li>
                    <li><a href="/workshop">Workshops</a></li>
                </ul>
            </li>
            <li class="hasDropdown">People
                    <ul>
                        @if (\App\User::havePermission(['PRESIDENT','HIGHBOARD','BOARD']))
                        <li><a href="/member">Members</a></li>
                        @endif
                        <li><a href="/sponsor">Sponsors</a></li>
                        <li><a href="/speaker">Speakers</a></li>
                    </ul>
                </li>
            <li><a href="/aboutus">About Us</a></li>
        </ul>
    </nav>
    
    <script src="{{ asset('js/navbar.js') }}"></script>
</div>