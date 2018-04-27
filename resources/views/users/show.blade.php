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
                <h2><i class="headerIcon fa fa-university" aria-hidden="true"></i>{{$user->college->university->name}}</h2>
                <h2><i class="headerIcon fa fa-graduation-cap" aria-hidden="true"></i>{{$user->college->name}}</h2>
                <h2><i class="headerIcon fa fa-phone" aria-hidden="true"></i>{{$user->phone_number}}</h2>
                <h2><i class="headerIcon fa fa-address-book-o" aria-hidden="true"></i>{{$user->email}}</h2>
                @if ($user->about != null)
                    <p><i class="headerIcon fa fa-sticky-note-o" aria-hidden="true"></i>{{$user->about}}</p>
                @endif
                <div class="inputContainer submitInput">
                    <a href="/user/{{$user->username}}/edit"><button>Edit</button></a>
                    {!! Form::open(['action' => ['UsersController@destroy', $user->username], 'method' => 'POST','onsubmit'=>'return confirm("Do you want to delete \"' . $user->username . '\" user? ")']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        <input class="delete" type="submit" value="Delete">
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="rightBoxBackground">
                @include('inc.logo');
            </div>
        </div>
    </div>
</div>
@endsection