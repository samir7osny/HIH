@extends('layouts.app')

@section('content')
<div class="outerBox windowHeight">
    <div class="innerBox">
        <div class="rightBox">
            <h1>
                Audience of "{{$workshop->name}}" workshop
            </h1>
            <div class="flexBox">
                    @foreach ($workshop->Audience as $enrollment)
                        <a  @if (count($workshop->questions) == 0)
                               
                            @else
                                href="/workshop/{{$workshop['name']}}/{{$enrollment->guest->user->username}}"
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