@extends('layouts.app')

@section('content')
<div class="outerBox windowHeight">
    <div class="innerBox">
        <div class="rightBox">
            <h1>
                {{$title}}
            </h1>
            <div class="flexBox">
                    <a href="/user/create" class="flexChild addMember">
                        <div class="inputContainer Button" style="height: inherit;">
                            <button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                        </div>
                    </a>
                    @foreach ($members as $member)
                        <a href="/user/{{$member->user->username}}" class="flexChild">
                            <img src="/storage/usersImages/{{$member->user->photo_url}}" alt="{{$member->user->first_name . " " . $member->user->last_name}}">
                            <h3 class="tableCell">
                                {{$member->user->first_name . " " . $member->user->last_name}}
                            </h3>
                        </a>
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endsection