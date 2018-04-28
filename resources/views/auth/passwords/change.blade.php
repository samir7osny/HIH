@extends('layouts.app')

@section('content')
<form class="outerBox windowHeight" method="POST" action="/password/change">
        @csrf
        <div class="innerBox">
                <div class="rightBox">
                        <div class="tableCell">
                                <h1>Change Your Password</h1>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <input class="requiredInput" type="password" name="old-password" required autofocus>
                                        <label class="" for="old-password">Enter The old password</label>
                                </div>

                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <input class="requiredInput" type="password" name="new-password" required>
                                        <label class="" for="new-password">Enter The password</label>
                                </div>

                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <input class="requiredInput" type="password" name="new-password_confirmation" required>
                                        <label class="" for="new-password_confirmation">Enter The new password again</label>
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
