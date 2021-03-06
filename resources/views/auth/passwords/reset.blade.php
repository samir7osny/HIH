@extends('layouts.app')

@section('content')
<form class="outerBox windowHeight" method="POST" action="{{ route('password.request') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="innerBox">
                <div class="rightBox">
                        <div class="tableCell">
                                <h1>Reset the password</h1>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <input class="requiredInput" type="email" name="email" value="{{ $email or old('email') }}" required autofocus>
                                        <label class="" for="email">Enter The email</label>
                                </div>

                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <input class="requiredInput" type="password" name="password" required>
                                        <label class="" for="password">Enter The password</label>
                                </div>

                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <input class="requiredInput" type="password" name="password_confirmation" required>
                                        <label class="" for="password_confirmation">Enter The password again</label>
                                </div>
                        
                                <div class="inputContainer fullWidth submitInput">
                                        <input type="submit" style="margin-top: 30px;" value="Reset Password">
                                </div>
                        </div>
                        
                        <div class="rightBoxBackground">
                                @include('inc.logo')
                        </div>
                </div>
        </div>
</form>
<script src="{{ asset('js/form.js') }}"></script>
@endsection
