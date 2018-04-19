@extends('layouts.app')
@section('content')
<div class="flexBox innerBox">
    @if($events->count()!=0)
        @foreach($events as $event)
                <a class="eventWorkshopPanel" href="event/{{$event['name']}}">
                    <div class="innerBox">
                        <div class="rightBox">
                            <h1>{{$event['name']}}</h1>
                            <p style="text-align:center">Number of Forms: {{$event->Audience()->count()}}</p><br>
                            <p style="position:relative;z-index:100;text-align:center;">{{str_limit($event['description'], 70)}}</p>
                        </div>
                    </div>

                    {{-- <div class="innerBox" style="background:url({{asset('images/temp/tomhanks.jpg')}});background-size: cover;">
                        <div class="rightBox" style="background:rgba(0,0, blue, 1)">
                            <div class="tableCell">
                                <h1>{{$event['name']}}</h1>
                                <p style="text-align:center">Number of Forms: {{$event->Audience()->count()}}</p><br>
                                <p style="position:relative;z-index:100;text-align:center;">{{str_limit($event['description'], 70)}}</p>
                            </div>
                            <div class="rightBoxBackground">
                                @include('inc.logo')
                            </div>
                        </div>
                    </div> --}}
                </a>
        @endforeach
    @else
            <h1>No Events To Show</h1>
    @endif
</div>
@endsection