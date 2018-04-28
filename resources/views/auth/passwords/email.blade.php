@extends('layouts.app')

@section('content')
<form class="outerBox windowHeight" method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="innerBox">
        <div class="rightBox">
            <div class="tableCell">
                <h1>Request password reset link</h1>
                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                    <input class="requiredInput" type="email" name="email" value="{{ old('email') }}" required>
                    <label class="" for="email">Enter The email</label>
                </div>
            
                <div class="inputContainer fullWidth submitInput">
                    <input type="submit" style="margin-top: 30px;" value="Send Password Reset Link">
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
