@extends('layouts.app')
@section('content')
<div class="outerBox windowHeight">
    @if($request)
        <div class="innerBox">
            <div class="rightBox">
                <div class="tableCell">
                    <h1>Deleting Request</h1>
                    <table class="eventWorkshopInfo">
                        <tr>
                            <td style="width:30%;">
                                <div class="flexBox">
                                        <a style="flex-basis:100%;" href="/user/{{$request->userSender->username}}" class="flexChild" style="height:80px;">
                                            <img src="/storage/usersImages/{{$request->userSender->photo_url}}" alt="{{$request->userSender->first_name . " " . $request->userSender->last_name}}">
                                            <h3 class="tableCell">
                                                    {{$request->userSender->first_name . " " . $request->userSender->last_name}}
                                            </h3>
                                        </a>
                                </div>
                            </td>
                            <td>
                                <i class="fa fa-clock-o" aria-hidden="true"></i> Sent at: {{$request->created_at}}
                                <br>
                                @if ($request->seen)<i class="fa fa-eye" aria-hidden="true"></i> Seen at: {{$request->seen_at}}
                                @else
                                <i class="fa fa-eye-slash" aria-hidden="true"></i> Unseen
                                @endif
                            </td>
                        </tr>
                    </table>
                    <div class="flexBox paddedBox" style="width:100%;">
                        @if ($request->userToDelete)
                            <a style="flex-basis:23%; height:80px;" href="/user/{{$request->userToDelete->username}}" class="flexChild toDelete">
                                <img src="/storage/usersImages/{{$request->userToDelete->photo_url}}" alt="{{$request->userToDelete->first_name . " " . $request->userToDelete->last_name}}">
                                <h3 class="tableCell" style="padding: 20px; width: initial;">
                                        {{$request->userToDelete->first_name . " " . $request->userToDelete->last_name}}
                                </h3>
                            </a>
                        @else
                            <a style="flex-basis:23%; height:80px; cursor:not-allowed;" class="flexChild toDelete">
                                <img src="/storage/usersImages/user.jpg" alt="{{$request->deleted_user_name}}">
                                <h3 class="tableCell">
                                        {{$request->deleted_user_name}}
                                </h3>
                            </a>
                        @endif
                    </div>
                    <div class="paddedBox" style="text-align:center; width:75%; margin:auto;">
                            {{$request->content}}
                    </div>
                    <div class="inputContainer Button between">
                        @if ($request->answered)
                            @if ($request->answer)
                                <h2 style="background:brown; color:#DDD;">The user has been deleted</h2>
                            @else
                                <h2 style="background:#DDD; color:rgb(37, 98, 63);">The request has been denied</h2>
                            @endif
                        @else
                            @if (Auth::user()->id !== $request->sender)
                                {!! Form::open(['action'=>['RequestsController@update',$request->id],'method'=>'PUT'])!!}
                                    <input type="checkbox" checked hidden name="answer">
                                    {{Form::submit('Accept',['class'=>'accept'])}}
                                {!!Form::close()!!}
                                {!! Form::open(['action'=>['RequestsController@update',$request->id],'method'=>'PUT'])!!}    
                                    <input type="checkbox" hidden name="answer">
                                    {{Form::submit('Deny',['class'=>'deny'])}}
                                {!!Form::close()!!}
                            @else
                                <h2 style="background:#DDD; color:rgb(37, 98, 63);">not answered yet!</h2>
                            @endif
                        @endif
                    </div>
                </div>
            
                <div class="rightBoxBackground">
                    @include('inc.logo')
                </div>
            </div>
        </div>
    @endif
</div>
<div class="popUpWindow">
</div>
@endsection