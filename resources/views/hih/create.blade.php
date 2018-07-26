@extends('layouts.app')

@section('content')
{!! Form::open(['action' => 'HomeController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'outerBox windowHeight']) !!}
        @csrf
        <div class="innerBox">
                <div class="rightBox">
                        <div class="tableCell">
                                <h1>Welcome to Hand In Hand website, Create the about information.</h1>
                                <div class="sponsors">
                                        <div class="member addMember addSponsor">
                                                <div class="inputContainer Button"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                                                </button></div>
                                        </div>
                                </div>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <select required class="requiredInput" name="university">
                                            <option value="0" selected disabled hidden>Choose The University</option>
                                            @foreach ($universities as $university)
                                                <option value="{{$university->id}}">{{$university->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <select required class="requiredInput" name="college">
                                            <option value="0" selected disabled hidden>Choose The University First</option>
                                        </select>
                                </div>
                                <div class="inputContainer highboards" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <div class="members">
                                                <div class="flexBox">
                                                        <div class="member addMember addHighboard">
                                                        <div class="inputContainer Button"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                                                        </button></div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <textarea contenteditable="true" class="requiredInput" name="mission" class="CKEDITOR"></textarea>
                                        <label class="" for="mission">mission</label>
                                        {{-- <p contenteditable="true" placeholder="about" class="CKEDITOR" name="about">{{ old('about') }}</p> --}}
                                </div>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <textarea contenteditable="true" class="requiredInput" name="vision" class="CKEDITOR"></textarea>
                                        <label class="" for="vision">vision</label>
                                        {{-- <p contenteditable="true" placeholder="about" class="CKEDITOR" name="about">{{ old('about') }}</p> --}}
                                </div>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <textarea contenteditable="true" class="requiredInput" name="story" class="CKEDITOR"></textarea>
                                        <label class="" for="story">story</label>
                                        {{-- <p contenteditable="true" placeholder="about" class="CKEDITOR" name="about">{{ old('about') }}</p> --}}
                                </div>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <input required class="requiredInput" value="{{ old('founder') }}" type="text" name="founder">
                                        <label class="" for="founder">Enter The founder name</label>
                                </div>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <span>Date of foundation</span>
                                        <input required class="requiredInput" value="{{ old('date_of_foundation') }}" type="date" name="date_of_foundation">
                                </div>
                                <div class="inputContainer fullWidth submitInput">
                                        <input type="submit" style="margin-top: 30px;" value="Save The information">
                                </div>
                        </div>
                        
                        <div class="rightBoxBackground">
                                @include('inc.logo')
                        </div>
                </div>
        </div>
{!! Form::close() !!}
<div class="popUpWindow">
        <div class="search" class="dark">
                @include('inc.logo')
                <div class="inputContainer">
                        <input placeholder="Search about member" type="text" name="searchKey">
                </div>
                <div class="members">
                <div class="results flexBox">

                </div>
                </div>
        </div>
</div>
<div class="popUpWindowSponsor">
    <div class="sponsorSearch" class="dark">
        @include('inc.logo')
        <div class="inputContainer">
                <input placeholder="Search about sponsor" type="text" name="searchKey">
        </div>
        <div class="members">
            <div class="results flexBox">
                <a target="blank" href="/sponsor/create" class="member addMember">
                    <div class="inputContainer Button" style="height: inherit;">
                        <button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/form.js') }}"></script>
<script src="{{ asset('js/highboard.js') }}"></script>
<script src="{{ asset('js/sponsor.js') }}"></script>
@endsection
