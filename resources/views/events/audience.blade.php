@extends('layouts.app')

@section('content')
<div class="outerBox windowHeight">
    <div class="innerBox">
        <div class="rightBox">
            <h1>
                Audience of "{{$event->name}}" event
            </h1>
            <div class="flexBox">
                    @foreach ($event->Audience as $enrollment)
                        <a  @if (count($event->questions) == 0)
                                
                            @else
                                href="/event/{{$event['name']}}/{{$enrollment->guest->user->username}}"
                            @endif
                            class="flexChild">
                            <img src="/storage/usersImages/{{$enrollment->guest->user->photo_url}}" alt="{{$enrollment->guest->user->first_name . " " . $enrollment->guest->user->last_name}}">
                            <h3 class="tableCell">
                                {{$enrollment->guest->user->first_name . " " . $enrollment->guest->user->last_name}}
                            </h3>
                        </a>
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endsection