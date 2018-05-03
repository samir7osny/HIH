@extends('layouts.app')
@section('content')
<div class="outerBox windowHeight">
    @if($task)
        <div class="innerBox">
            <div class="rightBox">
                <div class="tableCell">
                    <h1>Task</h1>
                    <table class="eventWorkshopInfo">
                        <tr>
                            <td style="width:30%;">
                                <div class="flexBox">
                                    @if(Auth::user()->id===$task->userReceiver->id)
                                        <a style="flex-basis:100%;" href="/user/{{$task->userSender->username}}" class="flexChild" style="height:80px;">
                                            <img src="/storage/usersImages/{{$task->userSender->photo_url}}" alt="{{$task->userSender->first_name . " " . $task->userSender->last_name}}">
                                            <h3 class="tableCell">
                                                    {{$task->userSender->first_name . " " . $task->userSender->last_name}}
                                            </h3>
                                        </a>
                                    @else
                                        <a style="flex-basis:100%;" href="/user/{{$task->userReceiver->username}}" class="flexChild" style="height:80px;">
                                            <img src="/storage/usersImages/{{$task->userReceiver->photo_url}}" alt="{{$task->userReceiver->first_name . " " . $task->userReceiver->last_name}}">
                                            <h3 class="tableCell">
                                                    {{$task->userReceiver->first_name . " " . $task->userReceiver->last_name}}
                                            </h3>
                                        </a>   
                                    @endif    
                                </div>
                            </td>
                            <td>
                                <i class="fa fa-clock-o" aria-hidden="true"></i> Sent at: {{$task->created_at}}
                                <br>
                                @if ($task->seen)<i class="fa fa-eye" aria-hidden="true"></i> Seen at: {{$task->seen_at}}
                                @else
                                <i class="fa fa-eye-slash" aria-hidden="true"></i> Unseen
                                @endif
                            </td>
                        </tr>
                    </table>
                    <div class="paddedBox" style="text-align:center; width:75%; margin:auto;">
                            {{$task->content}}
                    </div>
                    <div class="inputContainer Button between">
                        @if ($task->answered)
                            @if ($task->answer)
                                <h2 style=" background:#DDD; color:rgb(37, 98, 63);">The task has been accepted</h2>
                            @else
                                <h2 style="background:brown; color:#DDD;">The task has been denied</h2>
                            @endif
                        @else
                            @if (Auth::user()->id !== $task->userSender)
                                {!! Form::open(['action'=>['TasksController@update',$task->id],'method'=>'PUT'])!!}
                                    <input type="checkbox" checked hidden name="answer">
                                    {{Form::submit('Accept',['class'=>'accept'])}}
                                {!!Form::close()!!}
                                {!! Form::open(['action'=>['TasksController@update',$task->id],'method'=>'PUT'])!!}    
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