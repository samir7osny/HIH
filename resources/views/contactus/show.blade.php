@extends('layouts.app')
@section('content')
<div class="outerBox windowHeight">
    @if($message)
        <div class="innerBox">
            <div class="rightBox">
                <div class="tableCell">
                    <h1>Feedback</h1>
                    <table class="eventWorkshopInfo">
                        <tr>
                            <td style="width:30%;">
                                <div class="flexBox">
                                        <a style="flex-basis:100%;" class="flexChild" style="height:80px;">
                                            <img src="/storage/usersImages/user.jpg" alt="{{$message->sender_name}}">
                                            <h3 class="tableCell">
                                                    {{$message->sender_name}}
                                                    <br>
                                                    <span style="font-size:0.8em;">{{$message->sender_email}}</span>
                                            </h3>
                                        </a>
                                </div>
                            </td>
                            <td>
                                <i class="fa fa-clock-o" aria-hidden="true"></i> Sent at: {{$message->created_at}}
                            </td>
                        </tr>
                    </table>
                    <div class="paddedBox" style="text-align:center; width:75%; margin:auto;">
                            {{$message->content}}
                    </div>
                    @if (\App\User::havePermission(['PRESIDENT','HIGHBOARD']))
                    <div class="inputContainer Button between">
                        {!! Form::open(['action' => ['ContactUsController@destroy', $message->id], 'method' => 'POST']) !!}
                            {{Form::hidden('_method', 'DELETE')}}
                            <button class="delete confirmYes">Delete</button>
                        {!! Form::close() !!}
                    </div>
                    @endif
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