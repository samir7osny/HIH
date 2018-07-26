@extends('layouts.app')

@section('content')
<div class="outerBox windowHeight">
    <div class="innerBox">
        <div class="leftBox">
            <div class="darkBackground">
                <div class="tableCell">
                    <div class="square">
                        <img src="/storage/usersImages/{{$user->photo_url}}" alt="">
                        @if ($user->type == 0)
                            <span style="
                            color: #FFF;
                            font-size: 2em;
                            background: #25623f;
                            border-radius: 50%;
                            width: 70px;
                            height: 70px;
                            line-height: 70px;">M</span>
                        @else
                            <span style="
                            color: #FFF;
                            font-size: 2em;
                            background: #464779;
                            border-radius: 50%;
                            width: 70px;
                            height: 70px;
                            line-height: 70px;">G</span>
                        @endif
                    </div>
                    <h1>{{$user->first_name . " " . $user->last_name}}</h1>
                    @if ($user->userInfo->isMember())
                    <div style="font-size:0.4em;text-align:center" class="rateBar" totalValue="{{sprintf('%4.2f', ($user->userInfo->rate)*100.0/5.0)}}%">
                        <div class="bar" style="width:{{sprintf('%4.2f', ($user->userInfo->rate)*100.0/5.0)}}%">
                            @include('inc.RateB')
                        </div>
                        @include('inc.RateS')
                    </div>
                    <p class="userRate" style="font-size:1em;text-align:center"><span>{{round(($user->userInfo->rate)*10.0)/10.0}}</span>/5</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="rightBox">
            <div class="tableCell">
                <h2><i class="headerIcon fa fa-user" aria-hidden="true"></i>{{$user->username}}</h2>
                <h2><i class="headerIcon fa fa-key" aria-hidden="true"></i><a href="/password/change" style="text-decoration:underline">Change my password</a></h2>
                <h2><i class="headerIcon fa fa-university" aria-hidden="true"></i>{{$user->college->university->name}}</h2>
                <h2><i class="headerIcon fa fa-graduation-cap" aria-hidden="true"></i>{{$user->college->name}}</h2>
                @if ($user->type == 1)<h2><i class="headerIcon fa fa-calendar" aria-hidden="true"></i>Year Of Graduation: {{$user->userInfo->year_of_graduation}}</h2>@endif
                <h2><i class="headerIcon fa fa-phone" aria-hidden="true"></i>{{$user->phone_number}}</h2>
                <h2><i class="headerIcon fa fa-address-book-o" aria-hidden="true"></i>{{$user->email}}</h2>
                @if ($user->about != null)
                    <p><i class="headerIcon fa fa-sticky-note-o" aria-hidden="true"></i>{!! nl2br($user->about) !!}</p>
                @endif
                <div class="inputContainer submitInput">
                    @if(\App\User::havePermission(['PRESIDENT','TASK_HIGHBOARD',$user->id,'TASK_BOARD',$user->id]) 
                        && Auth::check() && Auth::user()->id != $user->id)
                    <a href="/task/create/{{$user->id}}"><button class="">Send task</button></a>
                    @endif
                    @if (Auth::check() && $user->username == Auth::user()->username)
                        <a href="/user/{{$user->username}}/edit"><button>Edit</button></a>
                    @endif
                    @if (\App\User::havePermission(['PRESIDENT','TYPE_HEAD','HR']) || Auth::check() && Auth::user()->id == $user->id)
                    <a href="/request/create/{{$user->id}}"><button class="delete">Delete</button></a>
                    @endif
                </div>
            </div>
            <div class="rightBoxBackground">
                @include('inc.logo');
            </div>
        </div>
    </div>
</div>
@if (\App\User::havePermission(['PRESIDENT','TYPE_HEAD','HR','TYPE_MEMBER','HR']))
<script src="{{asset('js/rate.js')}}"></script>
@endif
@endsection