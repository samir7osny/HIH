@extends('layouts.app')

@section('content')
<form id="loginForm" method="POST" class="outerBox windowHeight" action="{{ route('login') }}">
        @csrf
        <div class="innerBox">
                <div class="rightBox">
                        <div class="tableCell">
                                <h1>Login</h1>
                                <div class="inputContainer"  style="width:30%;margin:10px auto;font-size:1.5em;display:block;">
                                    <input type='text' class="requiredInput" name='username' value="{{ old('username') }}" required autofocus>  
                                    <label class="" for="username">Username</label>
                                </div>
                                <div class="inputContainer"  style="width:30%;margin:10px auto;font-size:1.5em;display:block;">
                                    <input type='password' class="requiredInput" name='password' required>                        
                                    <label class="" for="password">Password</label>
                                </div>
                                <div class="inputContainer"  style="width:30%;margin:10px auto;font-size:1.5em;display:block;">
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
                        
                        <div class="rightBoxBackground">
                                @include('inc.logo')
                        </div>
                </div>
        </div>
</form>
<script src="{{ asset('js/form.js') }}"></script>
@endsection
