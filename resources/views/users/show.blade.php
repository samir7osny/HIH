@extends('layouts.app')

@section('content')
<div class="outerBox windowHeight">
    <div class="innerBox">
        <div class="leftBox">
            <div class="darkBackground">
                <div class="tableCell">
                    <div class="square">
                        <img src="/storage/usersImages/{{$user->photo_url}}" alt="">
                    </div>
                    <h1>{{$user->first_name . " " . $user->last_name}}</h1>
                </div>
            </div>
        </div>
        <div class="rightBox">
            <div class="tableCell">
                <h2><i class="headerIcon fa fa-user" aria-hidden="true"></i>{{$user->username}}</h2>
                <h2><i class="headerIcon fa fa-key" aria-hidden="true"></i><a href="/password/change" style="text-decoration:underline">Change my password</a></h2>
                <h2><i class="headerIcon fa fa-university" aria-hidden="true"></i>{{$user->college->university->name}}</h2>
                <h2><i class="headerIcon fa fa-graduation-cap" aria-hidden="true"></i>{{$user->college->name}}</h2>
                <h2><i class="headerIcon fa fa-phone" aria-hidden="true"></i>{{$user->phone_number}}</h2>
                <h2><i class="headerIcon fa fa-address-book-o" aria-hidden="true"></i>{{$user->email}}</h2>
                @if ($user->about != null)
                    <p><i class="headerIcon fa fa-sticky-note-o" aria-hidden="true"></i>{{$user->about}}</p>
                @endif
                <div class="inputContainer submitInput">
                    <a href="/user/{{$user->username}}/edit"><button>Edit</button></a>
                    <button class="delete">Delete</button>
                </div>
            </div>
            <div class="rightBoxBackground">
                @include('inc.logo');
            </div>
        </div>
    </div>
</div>
<div class="popUpWindow">
    <div class="confirmationPopup">
        <h1>Confirm</h1>
        <p>Do you want to delete "{{ $user->username }}"  profile? </p>
        <div class="inputContainer Button between">
                {!! Form::open(['action' => ['UsersController@destroy', $user->username], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                    <input class="delete confirmYes" type="submit" value="Delete">
                {!! Form::close() !!}
                <button class="confirmCancel">Cancel</button>
        </div>
    </div>
</div>
@endsection