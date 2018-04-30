@extends('layouts.app')

@section('content')
{!! Form::open(['action' => ['SpeakersController@update', $speaker->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class' => 'outerBox windowHeight']) !!}
    <input type="hidden" name="type" value="0">
    <div class="innerBox">
        <div class="leftBox">
            <div class="darkBackground">
                <div class="tableCell">
                    <div class="square">
                        <img id="userImage" src="/storage/speakersImages/{{$speaker->photo_url}}" alt="">
                        <div class="inputImgHover"><span>Click To Edit</span></div>
                        <input type="file" accept="image/*" hidden name="userImage">
                        <span>@include('inc.mic')</span>
                    </div>
                    <div class="inputContainer name">
                        <input required class="requiredInput" value="{{ $speaker->title }}" type="text" name="title">
                        <label class="" for="title">Title</label>
                        <input required class="requiredInput withTitle" value="{{$speaker->first_name}}" type="text" name="first_name">
                        <label class="withTitle" for="first_name">First Name</label>
                        <input required class="requiredInput withTitle" value="{{$speaker->last_name}}" type="text" name="last_name">
                        <label class="withTitle" for="last_name">Last Name</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightBox">
            <div class="tableCell">
                <h2>
                    <i class="headerIcon fa fa-phone" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <input required class="requiredInput" value="{{$speaker->phone_number}}" type="text" name="phone_number">
                            <label class="" for="phone_number">Enter The Phone Number</label>
                    </div>
                </h2>
                <h2>
                    <i class="headerIcon fa fa-address-book-o" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <input required class="requiredInput" value="{{$speaker->email}}" type="email" name="email">
                            <label class="" for="email">Enter The E-Mail</label>
                    </div>
                </h2>
                <h2>
                    <i class="headerIcon fa fa-bookmark" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <input required class="requiredInput" value="{{$speaker->fields_of_interest}}" type="interests" name="interests">
                            <label class="" for="email">Enter The Interests</label>
                    </div>
                </h2>
                <h2>
                    <i class="headerIcon fa fa-sticky-note-o" aria-hidden="true"></i>
                    <div class="inputContainer">
                            <textarea contenteditable="true" name="about" class="CKEDITOR">{{$speaker->about}}</textarea>
                            <label class="" for="email">about</label>
                            {{-- <p contenteditable="true" placeholder="about" class="CKEDITOR" name="about">{{ old('about') }}</p> --}}
                    </div>
                </h2>
                <div class="inputContainer submitInput">
                    <input type="submit" value="Submit">
                </div>
            </div>
            <div class="rightBoxBackground">
                @include('inc.logo')
            </div>
        </div>
    </div>
{!! Form::close() !!}
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/form.js') }}"></script>
@endsection