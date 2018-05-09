@extends('layouts.app')

@section('content')
<div class="outerBox windowHeight">
    <div class="innerBox">
        <div class="leftBox">
            <div class="darkBackground">
                <div class="tableCell">
                    <div class="square">
                        <img src="/storage/speakersImages/{{$speaker->photo_url}}" alt="">
                        <span>@include('inc.mic')</span>
                    </div>
                    <h1>{{$speaker->title . ". " . $speaker->first_name . " " . $speaker->last_name}}</h1>
                </div>
            </div>
        </div>
        <div class="rightBox">
            <div class="tableCell">
                <h2><i class="headerIcon fa fa-phone" aria-hidden="true"></i>{{$speaker->phone_number}}</h2>
                <h2><i class="headerIcon fa fa-bookmark" aria-hidden="true"></i>{{$speaker->fields_of_interest}}</h2>
                <h2><i class="headerIcon fa fa-address-book-o" aria-hidden="true"></i>{{$speaker->email}}</h2>
                @if ($speaker->about != null)
                    <p><i class="headerIcon fa fa-sticky-note-o" aria-hidden="true"></i>{{$speaker->about}}</p>
                @endif
                <div class="inputContainer submitInput">
                    <a href="/speaker/{{$speaker->id}}/edit"><button>Edit</button></a>
                    <input class="delete" type="submit" value="Delete">
                </div>
            </div>
            <div class="rightBoxBackground">
                @include('inc.logo');
            </div>
        </div>
    </div>
</div>
<div class="popUpWindow">
    <div class="confirmationPopup">
        <h1>Confirm</h1>
        <p>Do you want to delete "{{ $speaker->title . ". " . $speaker->first_name . " " .$speaker->last_name }}"  profile? </p>
        <div class="inputContainer Button between">
                {!! Form::open(['action' => ['SpeakersController@destroy', $speaker->id], 'method' => 'POST']) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    <button class="delete confirmYes">Confirm</button>
                {!! Form::close() !!}
                <button class="confirmCancel">Cancel</button>
        </div>
    </div>
</div>
@endsection