@extends('layouts.app')

@section('content')
{!! Form::open(['action' => 'HomeController@update', 'method' => 'Put', 'enctype' => 'multipart/form-data', 'class' => 'outerBox windowHeight']) !!}
        @csrf
        <div class="innerBox">
                <div class="rightBox">
                        <div class="tableCell">
                                <h1>Edit the about information.</h1>
                                <div class="sponsors">
                                        @if ($hih->Sponsors())
                                                @foreach($hih->Sponsors() as $sponsor)
                                                <a target="blank" href="/sponsor/{{$sponsor->sponsor->id}}" class="member" s="{{$sponsor->sponsor->id}}">
                                                <img src="{{asset('/storage/sponsorsImages/'.$sponsor->sponsor->photo_url)}}"/>
                                                <input name="sponsor[]" hidden type="integer" value="{{$sponsor->sponsor->id}}"/>
                                                <span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                                                </a>
                                                @endforeach
                                        @endif
                                        <a class="member addMember addSponsor">
                                                <div class="inputContainer Button"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                                                </button></div>
                                        </a>
                                </div>
                                {{-- <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <select required class="requiredInput" name="university">
                                            <option value="0" disabled hidden>Choose The University</option>
                                            @foreach ($universities as $university)
                                                <option @if ($university->id == $hih->college->university->id)
                                                            selected="selected"
                                                        @endif
                                                value="{{$university->id}}">{{$university->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <select required class="requiredInput" name="college">
                                            <option value="0" disabled hidden>Choose The University First</option>
                                            @foreach ($hih->college->university->colleges as $college)
                                                <option @if ($college->id == $hih->college->id)
                                                        selected="selected"
                                                        @endif
                                                value="{{$college->id}}">{{$college->name}}</option>
                                            @endforeach
                                        </select>
                                </div> --}}
                                <div class="inputContainer highboards" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <div class="members">
                                                <div class="flexBox">
                                                        <div class="member addMember addHighboard">
                                                        <div class="inputContainer Button"><button class="addMember"><i class="fa fa-plus-square" aria-hidden="true"></i>
                                                        </button></div>
                                                        </div>
                                                        @if(\App\Highboard::count() != 0) 
                                                        @foreach (\App\Highboard::all() as $highboard)
                                                                <a target="blank" class="member" href="/user/{{$highboard->memberInfo->user->username}}" m="{{$highboard->memberInfo->id}}">
                                                                <img src="/storage/usersImages/{{$highboard->memberInfo->user->photo_url}}" alt="{{$highboard->memberInfo->user->first_name . " " . $highboard->memberInfo->user->last_name}}">
                                                                <h3 class="tableCell">{{$highboard->memberInfo->user->first_name . " " . $highboard->memberInfo->user->last_name}}</h3>
                                                                <span class="removeButton"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                                                                <input name="modirator[]" hidden type="integer" value="{{$highboard->memberInfo->id}}">
                                                                </a>
                                                        @endforeach
                                                        @endif
                                                </div>
                                        </div>
                                </div>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <span>mission</span>
                                        <textarea contenteditable="true" class="requiredInput" name="mission" class="CKEDITOR">{{$hih->mission}}</textarea>
                                        <label class="" for="mission">mission</label>
                                        {{-- <p contenteditable="true" placeholder="about" class="CKEDITOR" name="about">{{ old('about') }}</p> --}}
                                </div>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <span>vision</span>
                                        <textarea contenteditable="true" class="requiredInput" name="vision" class="CKEDITOR">{{$hih->vision}}</textarea>
                                        <label class="" for="vision">vision</label>
                                        {{-- <p contenteditable="true" placeholder="about" class="CKEDITOR" name="about">{{ old('about') }}</p> --}}
                                </div>
                                <div class="inputContainer" style="width:50%;margin:10px auto;font-size:1.5em;display:block;">
                                        <span>story</span>
                                        <textarea contenteditable="true" class="requiredInput" name="story" class="CKEDITOR">{{$hih->story}}</textarea>
                                        <label class="" for="story">story</label>
                                        {{-- <p contenteditable="true" placeholder="about" class="CKEDITOR" name="about">{{ old('about') }}</p> --}}
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
<script src="{{ asset('js/sponsor.js') }}"></script>
<script src="{{ asset('js/highboard.js') }}"></script>
@endsection
