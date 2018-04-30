@extends('layouts.app')

@section('content')
<div class="outerBox windowHeight">
    <div class="innerBox">
        <div class="rightBox">
            <h1>
                Speakers
            </h1>
            <div class="flexBox">
                    <a href="/speaker/create" class="flexChild addMember">
                        <div class="inputContainer Button" style="height:100%;">
                            <button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                        </div>
                    </a>
                    @foreach ($speakers as $speaker)
                        <a href="/speaker/{{$speaker->id}}" class="flexChild">
                            <img src="/storage/speakersImages/{{$speaker->photo_url}}" alt="{{$speaker->title . ". " . $speaker->first_name . " " . $speaker->last_name}}">
                            <h3 class="tableCell">
                                {{$speaker->title . ". " . $speaker->first_name . " " . $speaker->last_name}}
                                <br>
                                <span><i class="fa fa-bookmark" aria-hidden="true"></i>{{$speaker->fields_of_interest}}</span>
                            </h3>
                        </a>
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endsection